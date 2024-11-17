<?php

namespace App\UseCases;
use Illuminate\Support\Facades\Log;
use OpenAI\Client as OpenAIClient;

class CreateRunUseCase
{
    public static function execute(OpenAIClient $openai, array $options)
    {
        $threadId = $options['threadId'];
        $assistantId = $options['assistantId'] ?? 'asst_VVefvFU2YvJkLGhP4Yo521EN';

        // Crear la ejecución en el hilo especificado
        $run = $openai->threads()->runs()->create($threadId, [
            'assistant_id' => $assistantId,
            // Aquí puedes añadir instrucciones adicionales si es necesario
        ]);

        // Imprimir para depuración
        Log::info('Run created', ['run' => $run]);

        return $run;
    }
}
