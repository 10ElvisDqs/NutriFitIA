<?php

namespace App\Livewire;
use Livewire\Component;
use Livewire\Attributes\Lazy;
use OpenAI\Laravel\Facades\OpenAI;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

use App\Models\MedicalCondition;
use App\Models\AnthropometricMeasurement;
use App\Models\ConditionType;
use App\Models\TargetType;
use App\Models\Consultation;
use App\Models\PatientCondition;


class ConsultationForm extends Component
{

    public $prompt = '';  // El texto que el usuario ingresa
    public $name = '';
    public $response = 'HOlaaaaaaaaaaaaa';  // La respuesta que se va a mostrar de forma progresiva
    public $isWriting = false;  // Flag para saber si se está escribiendo la respuesta

    protected $openAIService;

    public $age, $gender, $weight, $height, $bmi = 0;
    public $dietary_preference, $physical_activity_level, $target_type;
    public $restrictions = [], $diseases = [], $allergies = [], $physical_conditions = [];
    public $consultation;

    // Ejemplo en un componente Livewire
    public $medicalConditions = [];
    public $selectedDiseases = [];
    public $selectedAllergies = [];
    public $selectedPhysicalConditions = [];

    //
    public $newConditionName = '';
    public $newConditionType = '';
    public $selectedType = '';

    public function mount()
    {
        $this->name = Auth::user()->name;

        $this->loadConditions();

    }

    public function generarPrediccion()
    {
        try {
            // Llamada a la API de OpenAI
            $response = OpenAI::chat()->create([
                    'model' => 'gpt-4o',
                    'messages' => [
                        ['role' => 'system', 'content' => 'Eres un experto en salud y fitness.'],
                        ['role' => 'user', 'content' => $this->prompt],
                    ],
                    'max_tokens' => 400, // Aumenta el límite de tokens
                    'temperature' => 0.5, // Puedes ajustarlo si deseas respuestas más consistentes
            ]);
            // Imprimir la respuesta completa para inspeccionar el contenido
            // \Log::info('Respuesta completa de OpenAI: ' . json_encode($response));
            usleep(10);
            // Obtener el contenido de la respuesta
            $responseContent = $response['choices'][0]['message']['content'];
            return $responseContent;

            // Eliminar el bloque de código para obtener el JSON real
            // if (preg_match('/\{.*\}/s', $responseContent, $matches)) {
            //     $jsonContent = $matches[0];  // Este es el JSON limpio
            // } else {
            //     throw new \Exception("La respuesta no contiene un JSON válido.");
            // }

            // Decodificar el JSON
            $responseArray = json_decode($jsonContent, true);

            // if (!is_array($responseArray)) {
            //     throw new \Exception("La respuesta de la API no está en formato JSON válido.");
            // }

            // Retornar los datos procesados
            return response()->json([
                'descripcion' => $responseArray['descripcion'] ?? 'Descripción no disponible.',
                'date' => now()->toDateString(),
                'type' => $responseArray['type'] ?? 'Ambos',  // Puedes ajustar el valor predeterminado según tu lógica
            ]);
        } catch (\Exception $e) {
            // Captura cualquier error y lo devuelve como respuesta
            return response()->json([
                'error' => 'Hubo un problema al procesar la predicción.',
                'details' => $e->getMessage(),
            ], 500);
        }
    }

    public function generatePredictionStreamed()
    {
        $this->isWriting = true; // Inicia el proceso de escritura
        $this->response = '';    // Limpia la respuesta anterior
        $this->dispatch('scrollToBottom'); // Hace scroll automático en el frontend



         try {
            // dd($this->prompt);
            // Llamada a OpenAI para obtener la respuesta en streaming
             $streamResponse = OpenAI::chat()->createStreamed([
                 'model' => 'gpt-4o',
                 'messages' => [
                     ['role' => 'system', 'content' => 'Eres un experto en salud y fitness.'],
                     ['role' => 'user', 'content' => $this->prompt],
                 ],
                 'max_tokens' => 300,
                 'temperature' => 0.7,
             ]);

             // Procesamos los fragmentos del flujo
             foreach ($streamResponse as $chunk) {
                 if (isset($chunk['choices'][0]['delta']['content'])) {
                     // Extrae y acumula los caracteres
                     $this->response .= $chunk['choices'][0]['delta']['content'];

                         $this->dispatch('responseUpdated', ['response' => $this->response]); // Envía el evento al frontend

                 }

                 usleep(10000); // Pausa de 100ms para simular escritura
             }
         } catch (\Exception $e) {
             // Manejo de errores
             $this->response = 'Hubo un error al procesar la predicción: ' . $e->getMessage();
             $this->dispatch('responseUpdated', ['response' => $this->response]); // Informa el error al frontend
         }

        $this->isWriting = false; // Finaliza el proceso de escritura
    }



    public function loadConditions()
    {
        $this->medicalConditions = \DB::table('medical_conditions')
            ->join('condition_types', 'medical_conditions.condition_type_id', '=', 'condition_types.id')
            ->select('medical_conditions.condition_id', 'medical_conditions.name', 'condition_types.name as type')
            ->get()
            ->groupBy('type'); // Agrupa por tipo (enfermedad, alergia, condición médica)
    }


    public function toggleCondition($type, $conditionId, $conditionName)
    {
        switch ($type) {
            case 'Restricciones':
                $this->updateArray($this->restrictions, $conditionId, $conditionName);
                break;
            case 'Enfermedad':
                $this->updateArray($this->diseases, $conditionId, $conditionName);
                break;
            case 'Alergia':
                $this->updateArray($this->allergies, $conditionId, $conditionName);
                break;
            case 'Condición física':
                $this->updateArray($this->physical_conditions, $conditionId, $conditionName);
                break;
        }
    }
    public function addCondition()
    {
        $this->validate([
            'newConditionName' => 'required|string|max:255',
            'selectedType' => 'required|exists:condition_types,id',
        ]);

        MedicalCondition::create([
            'name' => $this->newConditionName,
            'condition_type_id' => $this->selectedType,
        ]);
        // dd($p);


        $this->newConditionName = '';
        $this->newConditionType = '';
        $this->selectedType = '';
        $this->reset('newConditionName', 'selectedType');
        $this->loadConditions();
        session()->flash('message', 'Condición médica agregada con éxito.');
        // Asegúrate de que este código se ejecuta
        $this->dispatch('conditionAdded');
        $this->dispatch('post-created');
    }

    private function updateArray(&$array, $conditionId, $conditionName)
    {
        // Si el ID ya existe, eliminarlo
        if (isset($array[$conditionId])) {
            unset($array[$conditionId]);
        } else {
            // Si no existe, agregarlo
            $array[$conditionId] = $conditionName;
        }
    }
    public function updatedTargetType($value)
    {
        // Esto se ejecutará cuando se cambie la opción seleccionada
        $this->target_type = $value;
        // dd($this->target_type );
    }

    public function selectTarget($target)
    {
        // dd($target);
        $this->target_type = $target;
    }

    protected $rules = [
        'age' => 'required|integer|min:0',
        'gender' => 'required|string|in:masculino,femenino',
        'weight' => 'nullable|numeric|min:0',
        'height' => 'nullable|numeric|min:0',
        'bmi' => 'numeric|min:0',
        'dietary_preference' => 'required|string|max:255',
        'physical_activity_level' => 'required|string|max:255',
        'restrictions' => 'nullable|array',
        'restrictions.*' => 'string|max:255',
        'diseases' => 'nullable|array',
        'diseases.*' => 'string|max:255',
        'allergies' => 'nullable|array',
        'allergies.*' => 'string|max:255',
        'physical_conditions' => 'nullable|array',
        'physical_conditions.*' => 'string|max:255',
        'target_type' => 'required|string|max:255',
    ];

    public function updated($propertyName)
    {
        // Verificamos si el campo modificado es peso o altura
        if (in_array($propertyName, ['weight', 'height'])) {
            $this->calculateBmi();
        }
    }

    public function calculateBmi()
    {
        if ($this->weight > 0 && $this->height > 0) {
            $this->bmi = number_format($this->weight / ($this->height * $this->height), 2);
        } else {
            $this->bmi = ''; // Reiniciar si los valores no son válidos
        }
    }



    private function promtGPt($data){
            $this->prompt = "
            Necesito que seas actues como un experto Nutrisionista de la salud. Y Te voy a pasar estos datos para predices la mejor estrategia para mejorar su salud. Saluda al paciente su nombre  es :{$data['nombre']} :

            Datos del usuario:
            - Edad: {$data['age']}
            - Género: {$data['gender']}
            - Peso: {$data['weight']} kg
            - Altura: {$data['height']} m
            - Índice de Masa Corporal (IMC): {$data['bmi']}
            - Preferencia alimentaria: {$data['dietary_preference']}
            - Nivel de actividad física: {$data['physical_activity_level']}
            - Restricciones alimenticias: " . (empty($data['restrictions']) ? "Ninguna" : implode(', ', $data['restrictions'])) . "
            - Enfermedades: " . (empty($data['diseases']) ? "Ninguna" : implode(', ', $data['diseases'])) . "
            - Alergias: " . (empty($data['allergies']) ? "Ninguna" : implode(', ', $data['allergies'])) . "
            - Condiciones físicas: " . (empty($data['physical_conditions']) ? "Ninguna" : implode(', ', $data['physical_conditions'])) . "
            - Tipo de objetivo: {$data['target_type']}
            ";

    }

    private function generateStreamedResponse($model = 'gpt-4o-mini', $maxTokens = 300, $temperature = 0.7)
    {
        try {
            // dd($this->prompt);
            // Llamada a OpenAI para obtener la respuesta en streaming
             $streamResponse = OpenAI::chat()->createStreamed([
                 'model' => 'gpt-4o-mini',
                 'messages' => [
                     ['role' => 'system', 'content' => 'Eres un experto en salud y fitness.'],
                     ['role' => 'user', 'content' => $this->prompt],
                 ],
                 'max_tokens' => 1000, // Aumenta el límite de tokens
                 'temperature' => 0.5, // Puedes ajustarlo si deseas respuestas más consistentes
             ]);

             // Procesamos los fragmentos del flujo
             foreach ($streamResponse as $chunk) {
                 if (isset($chunk['choices'][0]['delta']['content'])) {
                     // Extrae y acumula los caracteres
                     $this->response .= $chunk['choices'][0]['delta']['content'];
                    // Enviar la respuesta actualizada al frontend
                    $this->dispatch('responseUpdated', ['response' => $this->response ?? '']);

                    // Usar un pequeño retraso para simular la escritura
                    usleep(50000); // 50ms para simular la escritura de cada letra

                 }

             }
         } catch (\Exception $e) {
             // Manejo de errores
             //texto rico macdow
             $this->response = 'Hubo un error al procesar la predicción: ' . $e->getMessage();
             $this->dispatch('responseUpdated', ['response' => $this->response]); // Informa el error al frontend
         }
    }

    private function saveConsulta($data){
        // Obtener el usuario autenticado
        $user = auth()->user(); // O usando Auth::user()

        // Verificar si el usuario está autenticado (opcional, por seguridad)
        if ($user) {
            // Actualizar los campos del usuario
            $user->update([
                'name' => $data['nombre'],
                'age' => $data['age'],
                'gender' => $data['gender'],
            ]);
        }

        $anthropometricMeasurement = AnthropometricMeasurement::create([
            'patient_id' => $user->id, // Usar el ID del usuario autenticado
            'weight' => $data['weight'],
            'height' => $data['height'],
            'bmi' => $data['bmi'],
        ]);
        // Crear nuevas relaciones para enfermedades (diseases)
        foreach ($data['diseases'] as $diseaseName) {

            // Busca la condición (enfermedad) por nombre
            $condition = MedicalCondition::where('name', $diseaseName)->first();
            if ($condition) {
                // Verifica si la relación entre el paciente y la condición ya existe
                $existingCondition = PatientCondition::where('patient_id', $user->id)
                    ->where('condition_id', $condition->condition_id)
                    ->first();
                // Si no existe, crea la relación
                if (!$existingCondition) {
                    PatientCondition::create([
                        'patient_id' => $user->id,  // El ID del paciente actual
                        'condition_id' => $condition->condition_id,  // El ID de la condición médica encontrada
                    ]);
                } else {
                    // Si la relación ya existe, puedes registrar un mensaje de log
                    \Log::info("La relación entre el paciente y la condición ya existe: Patient ID $user->id, Condition ID  $condition->condition_id");
                }
            } else {
                // Si no se encuentra la condición, podrías optar por crearla o manejar el error
                // MedicalCondition::create(['name' => $diseaseName]); // Crear la condición si es necesario
            }

        }

        // Crear nuevas relaciones para alergias
        foreach ($data['allergies'] as $allergyName) {
            // Busca la condición (enfermedad) por nombre
            $condition = MedicalCondition::where('name', $allergyName)->first();
            if ($condition) {
                // Verifica si la relación entre el paciente y la condición ya existe
                $existingCondition = PatientCondition::where('patient_id', $user->id)
                    ->where('condition_id', $condition->condition_id)
                    ->first();
                // Si no existe, crea la relación
                if (!$existingCondition) {
                    PatientCondition::create([
                        'patient_id' => $user->id,  // El ID del paciente actual
                        'condition_id' => $condition->condition_id,  // El ID de la condición médica encontrada
                    ]);
                } else {
                    // Si la relación ya existe, puedes registrar un mensaje de log
                    \Log::info("La relación entre el paciente y la condición ya existe: Patient ID $user->id, Condition ID  $condition->condition_id");
                }
            } else {
                // Si no se encuentra la condición, podrías optar por crearla o manejar el error
                // MedicalCondition::create(['name' => $diseaseName]); // Crear la condición si es necesario
            }
        }

        // Crear nuevas relaciones para condiciones físicas
        foreach ($data['physical_conditions'] as $physicalConditionName) {
            // Busca la condición (enfermedad) por nombre
            $condition = MedicalCondition::where('name', $physicalConditionName)->first();
            if ($condition) {
                // Verifica si la relación entre el paciente y la condición ya existe
                $existingCondition = PatientCondition::where('patient_id', $user->id)
                    ->where('condition_id', $condition->condition_id)
                    ->first();
                // Si no existe, crea la relación
                if (!$existingCondition) {
                    PatientCondition::create([
                        'patient_id' => $user->id,  // El ID del paciente actual
                        'condition_id' => $condition->condition_id,  // El ID de la condición médica encontrada
                    ]);
                } else {
                    // Si la relación ya existe, puedes registrar un mensaje de log
                    \Log::info("La relación entre el paciente y la condición ya existe: Patient ID $user->id, Condition ID  $condition->condition_id");
                }
            } else {
                // Si no se encuentra la condición, podrías optar por crearla o manejar el error
                // MedicalCondition::create(['name' => $diseaseName]); // Crear la condición si es necesario
            }
        }

        // Obtener el target_type_id correspondiente al tipo de objetivo (asumiendo que está en la tabla 'target_types')
        $targetType = TargetType::where('name', $data['target_type'])->first();
        // dd($targetType);
        // Crear la consulta para el usuario autenticado
        $this->consultation = Consultation::create([
            'patient_id' => $user->id, // Usar el ID del usuario autenticado
            'target_type_id' => $targetType->target_type_id, // El ID del tipo de objetivo
            'anthropometric_measurement_id' => $anthropometricMeasurement->id, // ID de las mediciones antropométricas
            'date' => now(), // Fecha actual
            'dietary_preference' => $data['dietary_preference'],
            'physical_activity_level' => $data['physical_activity_level'],
            'restrictions' => json_encode($data['restrictions']), // Si necesitas guardar restricciones como JSON
        ]);
    }

    public function submit()
    {
        $this->validate();


        $data = [
            'nombre' => $this->name,
            'age' => $this->age,
            'gender' => $this->gender,
            'weight' => $this->weight,
            'height' => $this->height,
            'bmi' => $this->bmi,
            'dietary_preference' => $this->dietary_preference,
            'physical_activity_level' => $this->physical_activity_level,
            'restrictions' => empty($this->restrictions) ? 'Ninguno' : $this->restrictions,
            'diseases' => empty($this->diseases) ? 'Ninguno' : $this->diseases,
            'allergies' => empty($this->allergies) ? 'Ninguno' : $this->allergies,
            'physical_conditions' => empty($this->physical_conditions) ? 'Ninguno' : $this->physical_conditions,
            'target_type' => $this->target_type,
        ];
        $this->saveConsulta($data);

        $data = [
            'id_consulta'=>$this->consultation->consultation_id,
            'nombre' => $this->name,
            'age' => $this->age,
            'gender' => $this->gender,
            'weight' => $this->weight,
            'height' => $this->height,
            'bmi' => $this->bmi,
            'dietary_preference' => $this->dietary_preference,
            'physical_activity_level' => $this->physical_activity_level,
            'restrictions' => empty($this->restrictions) ? 'Ninguno' : $this->restrictions,
            'diseases' => empty($this->diseases) ? 'Ninguno' : $this->diseases,
            'allergies' => empty($this->allergies) ? 'Ninguno' : $this->allergies,
            'physical_conditions' => empty($this->physical_conditions) ? 'Ninguno' : $this->physical_conditions,
            'target_type' => $this->target_type,
        ];

        return redirect()->route('recomendacionIA', $data);

        $this->response = '';    // Limpia la respuesta anterior
        $this->promtGPt( $data );
        $this->response = '';    // Limpia la respuesta anterior
        $this->isWriting = true; // Inicia el proceso de escritura
        $this->response = $this->generarPrediccion();
        $this->dispatch('responseUpdated', ['response' => $this->response ?? '']);
        $this->isWriting = false; // Finaliza el proceso de escritura



    }

    public function placeholder()
    {
        return view('livewire.typing-loader-component');
    }

    public function render()
    {
        $conditionTypes = $conditionType = ConditionType::all();
        $targetType =  TargetType::all();

        return view('livewire.consultation-form',compact('conditionTypes','targetType'));
    }
}
