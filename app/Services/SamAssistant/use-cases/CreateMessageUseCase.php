<?php

namespace App\UseCases;

use OpenAI\Client as OpenAIClient;

class CreateMessageUseCase
{
    public static function execute(OpenAIClient $openai, array $options)
    {
        $threadId = $options['threadId'];
        $question = $options['question'];

        // Crear el mensaje en el hilo especificado
        $message = $openai->threads()->messages()->create($threadId, [
            'role' => 'user',
            'content' => $question,
        ]);

        return $message;
    }
}
