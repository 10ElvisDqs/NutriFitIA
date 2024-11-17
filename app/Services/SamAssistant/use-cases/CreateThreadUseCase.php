<?php

namespace App\Services\OpenAI;

use OpenAI\Client as OpenAIClient;

class CreateThreadUseCase
{
    protected $openai;

    public function __construct(OpenAIClient $openai)
    {
        $this->openai = $openai;
    }

    public function handle()
    {
        // Crear un hilo en OpenAI
        $response = $this->openai->threads()->create();  // Asegúrate de que `threads` sea accesible

        // Verifica si la respuesta tiene un id
        if (isset($response['id'])) {
            return ['id' => $response['id']];
        }

        // En caso de error, puedes manejarlo aquí
        throw new \Exception('Error al crear el hilo en OpenAI.');
    }
}
