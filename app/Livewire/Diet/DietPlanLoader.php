<?php

namespace App\Livewire\Diet;

use Livewire\Component;
use Livewire\Attributes\On;

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

class DietPlanLoader extends Component
{
    public $isLoading = true;
    public $data;
    public $progress = 0; // Progreso inicial
    public $nombre;
    public $age;
    public $gender;
    public $weight;
    public $height;
    public $bmi;
    public $dietary_preference;
    public $physical_activity_level;
    public $diseases;
    public $allergies;
    public $physical_conditions;
    public $target_type;
    public $recommendation_ia_id;
    public $user_id;



    public function mount($user_id,$recommendation_ia_id, $age, $gender, $weight, $height, $bmi, $dietary_preference, $physical_activity_level, $diseases, $allergies, $physical_conditions, $target_type)
    {
        $this->user_id = $user_id;
        $this->recommendation_ia_id=$recommendation_ia_id;
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
        // Simula un incremento del progreso cada segundo

        // Muestra la pantalla de carga inicialmente
        $this->isLoading = true;



    }

    public function generarPlanDieta($id_user,$age, $gender, $weight, $height, $bmi, $dietary_preference, $physical_activity_level, $diseases, $allergies, $physical_conditions, $target_type, $goal, $days = 7) {
        // Convertir los arrays a cadenas si es necesario
        $diseases = is_array($diseases) ? implode(', ', $diseases) : $diseases;
        $allergies = is_array($allergies) ? implode(', ', $allergies) : $allergies;
        $physical_conditions = is_array($physical_conditions) ? implode(', ', $physical_conditions) : $physical_conditions;
        // $restrictions = is_array($restrictions) ? implode(', ', $restrictions) : $restrictions;

        // Creamos el prompt con los datos del usuario
        $prompt = "
        Basándote en los siguientes datos de un usuario, genera un plan de dieta personalizado:
        - Edad: $age años
        - Género: $gender
        - Peso: $weight kg
        - Altura: $height cm
        - IMC: $bmi
        - Preferencias dietéticas: $dietary_preference
        - Nivel de actividad física: $physical_activity_level
        - Enfermedades: $diseases
        - Alergias: $allergies
        - Condiciones físicas: $physical_conditions
        - Tipo de objetivo: $target_type
        - Objetivo de la dieta: '$goal'

        Calcula las metas nutricionales diarias (calorías, proteínas, grasas y carbohidratos) necesarias para cumplir con este objetivo. Luego, proporciona un plan con los siguientes detalles:

        La respuesta debe estar en formato JSON estructurado:
            {
                'nombre': 'Plan para $goal',
                'objetivo': '$goal',
                'calorias_diarias': ...,
                'proteinas_diarias': ...,
                'grasas_diarias': ...,
                'carbohidratos_diarios': ...,
                'fecha_inicio': '" . now()->toDateString() . "',
                'duracion_dias': $days
            }
            Devuelve solo el JSON, sin texto adicional.
            ";
            // ini_set('max_execution_time', 300);

            // Llamada a OpenAI
            $response = OpenAI::chat()->create([
                'model' => 'gpt-4o-mini',
                'messages' => [
                    ['role' => 'system', 'content' => 'Eres un experto en nutrición y planificación de dietas.'],
                    ['role' => 'user', 'content' => $prompt],
                ],
                'max_tokens' => 1000,
                'temperature' => 0.5,
            ]);

            if (preg_match('/\{.*\}/s',$response['choices'][0]['message']['content'], $matches)) {
                // Extracción del JSON limpio
                $jsonContent = $matches[0];
            } else {
                throw new \Exception("La respuesta no contiene un JSON válido.");
            }

            // Decodificar el JSON a un array asociativo
            $data = json_decode($jsonContent, true);

            // Guarda los datos en la tabla 'diets'
            $diet = new Diet();
            $diet->user_id = $id_user;
            $diet->recommendation_ia_id=$this->recommendation_ia_id;
            $diet->name = $data['nombre'];
            $diet->goal = $data['objetivo'];
            $diet->daily_calories = $data['calorias_diarias'];
            $diet->daily_proteins = $data['proteinas_diarias'];
        $diet->daily_fats = $data['grasas_diarias'];
        $diet->daily_carbs = $data['carbohidratos_diarios'];
        $diet->start_date = $data['fecha_inicio'];
        $diet->end_date = now()->addDays($data['duracion_dias'])->toDateString();
        $diet->save();

        return $diet;
    }


    public function generarRecetas($diet_id, $days = 7)
    {
        ini_set('max_execution_time', 300); // 300 segundos

        // Obtener la dieta desde la base de datos
        $diet = Diet::findOrFail($diet_id);

        // Establecer la fecha de inicio de la dieta
        $startDate = Carbon::parse($diet->start_date);
        // Iterar sobre los días que necesitamos generar
        for ($i = 0; $i < $days; $i++) {
            // Obtener la fecha del día actual
            $currentDate = $startDate->addDays($i);
            $diaNombre = $currentDate->locale('es')->isoFormat('dddd');  // Nombre del día en español
            $fecha = $currentDate->format('Y-m-d');  // Formato 'YYYY-MM-DD'
            try{
                // Insertar el día en la tabla `days`
                $day = Day::create([
                    'diet_id' => $diet_id,
                    'name' => $diaNombre,
                    'date' => $fecha
                ]);
                // dd($day);
            } catch (\Exception $e) {
                dd($e->getMessage());  // Imprime el mensaje de error
            }

            // Preparar el prompt para la IA
            $prompt = "
            Usando las siguientes metas nutricionales:
            - Calorías diarias: {$diet->daily_calories}
            - Proteínas diarias: {$diet->daily_proteins}
            - Grasas diarias: {$diet->daily_fats}
            - Carbohidratos diarios: {$diet->daily_carbs}

            Crea un plan de dieta para el día {$fecha} con desayuno, almuerzo y cena.
            Proporciona los siguientes detalles para cada comida:
            - Nombre de la receta
            - Ingredientes
            - Instrucciones de preparación
            - Beneficios
            - Duración estimada
            - Calorias de la receta
            - Proteinas de la receta
            - Grasas de la receta
            - Carbohidatros de la receta
            fomrato de salida :
            {
                'recetas': {
                    'desayuno': {
                        'name': ,
                        'ingredients':,
                        'preparation': ,
                        'benefits': ,
                        'duration': ,
                        'image_url': ,
                        'video_url':
                    },
                    'almuerzo': {
                        'name': ,
                        'ingredients':,
                        'preparation': ,
                        'benefits': ,
                        'duration':,
                        'image_url': ,
                        'video_url':
                    },
                    'cena': {
                        'name': ,
                        'ingredients': ,
                        'preparation':,
                        'benefits': ,
                        'duration': ,
                        'image_url': ,
                        'video_url':
                    }
                }
            }
            Devuelve solo el JSON, sin texto adicional.
            ";
            // Llamada a OpenAI para generar las recetas
            $response = OpenAI::chat()->create([
                'model' => 'gpt-4o-mini',
                'messages' => [
                    ['role' => 'system', 'content' => 'Eres un experto en nutrición y planificación de dietas.'],
                    ['role' => 'user', 'content' => $prompt],
                ],
                'max_tokens' => 3000,
                'temperature' => 0.5,
            ]);

            if (preg_match('/\{.*\}/s',$response['choices'][0]['message']['content'], $matches)) {
                // Extracción del JSON limpio
                $jsonContent = $matches[0];
            } else {
                throw new \Exception("La respuesta no contiene un JSON válido.");
            }

            // Decodificar el JSON a un array asociativo
            $recetas = json_decode($jsonContent, true);



            // Iterar sobre las recetas generadas y guardarlas en la base de datos
            foreach ($recetas['recetas'] as $meal => $recipeData) {

                // Convertir los ingredientes a formato JSON
                $ingredientsJson = json_encode($recipeData['ingredients']);

                try{
                    // Crear la receta en la tabla `recipes`
                    $recipe = Recipe::create([
                        'name' => $recipeData['name'],
                        'ingredients' => $ingredientsJson,// Guardar los ingredientes como JSON
                        'preparation' => $recipeData['preparation'],
                        'benefits' => $recipeData['benefits'],
                        'duration' => $recipeData['duration'],
                        'image_url' => $recipeData['image_url'] ?? null,  // Usar valor por defecto si no hay imagen
                        'video_url' => $recipeData['video_url'] ?? null,  // Usar valor por defecto si no hay video
                    ]);
                } catch (\Exception $e) {
                    dd($e->getMessage());  // Imprime el mensaje de error
                }

                // Relacionar la receta con el día (para desayuno, almuerzo, cena)
                $mealTypeId = $this->obtenerMealTypeId($meal);  // Método que devuelve el tipo de comida


                try{
                    $day_recipe = DayRecipe::create([
                        'day_id' => $day->id,
                        'recipe_id' => $recipe->id,
                        'meal_type_id' => $mealTypeId,
                        'completed' => false,
                    ]);
                    // dd($day_recipe);

                } catch (\Exception $e) {
                    dd($e->getMessage());  // Imprime el mensaje de error
                }
            }
        }



        return response()->json([
            'message' => 'Recetas generadas e insertadas exitosamente'
        ]);
    }

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

    public function startProgress()
    {
        $this->reset('progress');
        $this->dispatch('start-loading-bar');
    }
    public function render()
    {
        // Usa un evento del navegador para iniciar el método pesado después del renderizado inicial
        $this->dispatch('start-diet-generation');
        return view('livewire.diet.diet-plan-loader');
    }

    #[On('startGeneration')]
    public function startGeneration()
    {
    $this->isLoading = true; // Muestra la barra de carga

    $startTime = microtime(true); // Inicia el temporizador
    // // Paso 1: Generar la dieta
    // $this->progress = 25; // Actualiza el progreso
    // $this->dispatch('progressUpdatedd'); // Actualiza en la vista
    $diet = $this->generarPlanDieta($this->user_id, $this->age, $this->gender, $this->weight, $this->height, $this->bmi,
    $this->dietary_preference, $this->physical_activity_level, $this->diseases, $this->allergies,
    $this->physical_conditions, $this->target_type, 7);

    // dd($diet);
    // Paso 2: Generar recetas
    // $this->progress = 75; // Actualiza el progreso
    // $this->dispatch('progressUpdated'); // Actualiza en la vista
    $this->generarRecetas($diet->id, 7);

    // Paso 3: Finalizar
    // $this->progress = 100;
    // $this->dispatch('progressUpdated'); // Actualiza en la vista
    // sleep(1); // Opcional, para simular un retraso de finalización

    $endTime = microtime(true); // Fin del temporizador
    $executionTime = round($endTime - $startTime, 2);

    // Oculta la pantalla de carga y redirige
    $this->isLoading = false;
    session()->flash('message', "Plan generado en $executionTime segundos.");
    return redirect()->route('diet');
    }
}
