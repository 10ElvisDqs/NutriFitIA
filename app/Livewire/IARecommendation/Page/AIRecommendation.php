<?php

namespace App\Livewire\IARecommendation\Page;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Auth;
use App\Models\IaRecommendation;
// use App\Models\DayRecipe;
use App\Models\DayRecipe;
use App\Models\Day;
use App\Models\Recipe;
use App\Models\MealType;

use App\Models\Diet;

use App\Jobs\GenerateDietJob;

class AIRecommendation extends Component
{
    public $id_consulta;
    public $nombre; public $age; public $gender; public $weight; public $height; public $bmi;
    public $dietary_preference; public $physical_activity_level; public $restrictions; public $diseases; public $allergies;
    public $physical_conditions; public $target_type;

    public $prompt;
    public $response;
    public $iaRecommendation;
    public $isLoading = false;

    public function mount($id_consulta,$nombre, $age, $gender, $weight, $height, $bmi, $dietary_preference, $physical_activity_level, $diseases, $allergies, $physical_conditions,$restrictions, $target_type)
    {
        $this->id_consulta = $id_consulta;
        $this->nombre = $nombre;
        $this->age = $age;
        $this->gender = $gender;
        $this->weight = $weight;
        $this->height = $height;
        $this->bmi = $bmi;
        $this->dietary_preference = $dietary_preference;
        $this->physical_activity_level = $physical_activity_level;
        $this->diseases = $diseases;
        $this->allergies = $allergies;
        $this->physical_conditions = $physical_conditions;
        $this->target_type = $target_type;
        $this->restrictions = $restrictions;

        $this->promtGPt();
        $this->generarPrediccion();
        $this->dispatch('start-loading');

    }

    public function generarPlan(){

        $days = 7;
        $userId= Auth::id();

            $data = [
                'user_id' => $userId,
                'recommendation_ia_id'=> $this->iaRecommendation->recommendation_ia_id,
                'age' => $this->age,
                'gender' => $this->gender,
                'weight' => $this->weight,
                'height' => $this->height,
                'bmi' => $this->bmi,
                'dietary_preference' => $this->dietary_preference,
                'physical_activity_level' => $this->physical_activity_level,
                'diseases' => empty($this->diseases) ? 'Ninguno' : $this->diseases,
                'allergies' => empty($this->allergies) ? 'Ninguno' : $this->allergies,
                'physical_conditions' => empty($this->physical_conditions) ? 'Ninguno' : $this->physical_conditions,
                'target_type' => $this->target_type,
                'days'=>$days
            ];
        return redirect()->route('generarPlan',$data);
    }

    private function promtGPt(){
        $this->prompt = "
            Actúa como un experto en nutrición de la salud. Te proporcionaré datos específicos de un paciente para que generes una recomendación detallada y personalizada con base en su perfil.
            **Saluda al paciente por su nombre** ({$this->nombre}) y genera una respuesta en el siguiente formato JSON, adaptada para su almacenamiento:
            ```json
            {
                \"description\": \"[Describa la recomendación detallada para mejorar la salud del paciente, incluyendo estrategias de alimentación, actividad física y otras consideraciones relevantes.]\",
                \"type\": \"[Tipo de estrategia: dieta, ejercicio, o combinada]\"
            }
            ```
            **Datos del paciente:**
            - Edad: {$this->age}
            - Género: {$this->gender}
            - Peso: {$this->weight} kg
            - Altura: {$this->height} m
            - Índice de Masa Corporal (IMC): {$this->bmi}
            - Preferencia alimentaria: {$this->dietary_preference}
            - Nivel de actividad física: {$this->physical_activity_level}
            - Restricciones alimenticias: " . (empty($data['restrictions']) ? "Ninguna" : implode(', ', $data['restrictions'])) . "
            - Enfermedades: " . (empty($data['diseases']) ? "Ninguna" : implode(', ', $data['diseases'])) . "
            - Alergias: " . (empty($data['allergies']) ? "Ninguna" : implode(', ', $data['allergies'])) . "
            - Condiciones físicas: " . (empty($data['physical_conditions']) ? "Ninguna" : implode(', ', $data['physical_conditions'])) . "
            - Tipo de objetivo: {$this->target_type}

            **Notas adicionales:**
            - La recomendación debe ser clara, concisa y específica, considerando las restricciones, alergias y condiciones físicas del paciente.
            - Incluye al menos un objetivo principal y una sugerencia concreta de cómo alcanzarlo.
            ";
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
                'max_tokens' => 400,
                'temperature' => 0.5,
            ]);

            // Obtener el contenido de la respuesta
            $this->response = $response['choices'][0]['message']['content'];
            // Convertir el contenido JSON en un array PHP
            $recommendationData = $this->response;
            // Eliminar el bloque de código para obtener el JSON real
             if (preg_match('/\{.*\}/s', $recommendationData, $matches)) {
                 $jsonContent = $matches[0];  // Este es el JSON limpio
             } else {
                 throw new \Exception("La respuesta no contiene un JSON válido.");
             }

            // Decodificar el JSON
            $responseArray = json_decode($jsonContent, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                dd('Error en el JSON: ' . json_last_error_msg());
            }


            // Insertar en la base de datos usando Eloquent
            try {
                $this->iaRecommendation = IaRecommendation::create([
                    'description' => $responseArray['description'],
                    'date' => Carbon::now(),
                    'type' => $responseArray['type'],
                    'consultation_id' => $this->id_consulta,
                ]);
                // dd($this->iaRecommendation );
            } catch (\Exception $e) {
                dd($e->getMessage());  // Imprime el mensaje de error
            }


            // Emitir un evento para notificar la actualización
            $this->dispatch('responseUpdatedText', ['response' => $this->iaRecommendation->description ?? '']);

        } catch (\Exception $e) {
            // Captura cualquier error y lo devuelve como respuesta
            return response()->json([
                'error' => 'Hubo un problema al procesar la predicción.',
                'details' => $e->getMessage(),
            ], 500);
        }
    }
    // Dentro de tu controlador o clase
    public function obtenerMealTypeId($meal)
    {
        // Convertir el nombre del tipo de comida a minúsculas y buscarlo en la base de datos
        $mealType = MealType::where('name', strtolower($meal))->first();

        // Verificar si encontramos el tipo de comida
        if ($mealType) {
            return $mealType->id;  // Retornar el ID del tipo de comida encontrado
        }

        // Si no se encuentra, puedes manejar el error o retornar un valor predeterminado
        throw new \Exception("El tipo de comida '{$meal}' no se encuentra en la base de datos.");
    }

    public function render()
    {
        // $this->promtGPt();
        return view('livewire.i-a-recommendation.page.a-i-recommendation');
    }
}
