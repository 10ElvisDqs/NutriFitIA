<?php

namespace App\UseCases;

use OpenAI\Client as OpenAIClient;

class CheckCompleteStatusUseCase
{
    public static function execute(OpenAIClient $openai, array $options)
    {
        $threadId = $options['threadId'];
        $runId = $options['runId'];

        $runStatus = $openai->threads()->runs()->retrieve($threadId, $runId);

        // Muestra el estado actual en los logs
        info(['status' => $runStatus['status']]);

        if ($runStatus['status'] === 'completed') {
            return $runStatus;
        }

        // Espera un segundo
        sleep(1);

        // Llama recursivamente hasta que el estado sea 'completed'
        return self::execute($openai, $options);
    }
}
