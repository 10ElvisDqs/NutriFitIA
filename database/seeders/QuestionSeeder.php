<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Question;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [
            ['descripcion' => '¿Prefieres comidas altas en proteínas?'],
            ['descripcion' => '¿Cuántas veces por semana haces ejercicio?'],
            ['descripcion' => '¿Te sientes con energía al levantarte?'],
            ['descripcion' => '¿Prefieres seguir una rutina de gimnasio o actividad al aire libre?'],
            ['descripcion' => '¿Tienes restricciones dietéticas específicas?'],
            ['descripcion' => '¿Cuánto tiempo puedes dedicar al ejercicio diariamente?'],
            ['descripcion' => '¿Qué tan importante es para ti perder peso?'],
            ['descripcion' => '¿Te interesa aumentar tu masa muscular?'],
            ['descripcion' => '¿Tienes acceso a equipos de ejercicio?'],
            ['descripcion' => '¿Prefieres comidas preparadas en casa o comida rápida?'],
            ['descripcion' => '¿Qué nivel de intensidad te gusta en tus actividades físicas?'],
            ['descripcion' => '¿Tienes algún problema de salud que limite tus actividades?'],
            ['descripcion' => '¿Cuánto tiempo dedicas actualmente a planificar tus comidas?'],
            ['descripcion' => '¿Te gusta realizar actividades físicas en grupo?'],
            ['descripcion' => '¿Tienes interés en probar nuevas recetas saludables?'],
        ];

        foreach ($questions as $question) {
            Question::create($question);
        }
    }
}
