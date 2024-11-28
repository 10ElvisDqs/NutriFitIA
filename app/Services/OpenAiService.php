<?php
namespace App\Services;

use OpenAI\Laravel\Facades\OpenAI;

class OpenAIService
{
    public function generarPrediccion($prompt, $model = 'gpt-4o-mini', $maxTokens = 300, $temperature = 0.7)
    {
        try {
            // Llamada a la API de OpenAI
            $response = OpenAI::chat()->create([
                'model' => $model,  // Usamos el modelo 'gpt-4o-mini'
                'messages' => [
                    ['role' => 'system', 'content' => 'Eres un experto en salud y fitness.'],
                    ['role' => 'user', 'content' => $prompt],
                ],
                'max_tokens' => $maxTokens,
                'temperature' => $temperature,
            ]);

            // Imprimir la respuesta completa para inspeccionar el contenido
            // \Log::info('Respuesta completa de OpenAI: ' . json_encode($response));

            // Obtener el contenido de la respuesta
            $responseContent = $response['choices'][0]['message']['content'];

            // Eliminar el bloque de código para obtener el JSON real
            if (preg_match('/\{.*\}/s', $responseContent, $matches)) {
                $jsonContent = $matches[0];  // Este es el JSON limpio
            } else {
                throw new \Exception("La respuesta no contiene un JSON válido.");
            }

            // Decodificar el JSON
            $responseArray = json_decode($jsonContent, true);

            if (!is_array($responseArray)) {
                throw new \Exception("La respuesta de la API no está en formato JSON válido.");
            }

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

    // Método para streaming de la respuesta (escritura en tiempo real)
    public function generateStreamedResponse($prompt, $model = 'gpt-4o-mini', $maxTokens = 300, $temperature = 0.7)
    {
        try {
            $response = OpenAI::chat()->createStreamed([
                'model' => $model,
                'messages' => [
                    ['role' => 'system', 'content' => 'Eres un experto en salud y fitness.'],
                    ['role' => 'user', 'content' => $prompt],
                ],
                'max_tokens' => $maxTokens,
                'temperature' => $temperature,
            ]);

            // Devuelve los fragmentos mientras se escriben
            return $response;

        } catch (\Exception $e) {
            return 'Hubo un error al procesar la predicción: ' . $e->getMessage();
        }
    }


    public function createChatResponse(array $messages, string $model = 'gpt-3.5-turbo')
    {
        return OpenAI::chat()->createStreamed([
            'model' => $model,
            'messages' => $messages,
        ]);
    }

    public function generateTitle(array $messages)
    {
        $prompt = [
            'role' => 'system',
            'content' => 'Create a title based on previous messages, without anything but the title. Title should be without quotation marks and not be prefixed with anything like "Title:"'
        ];

        $messagesWithInstruction = array_merge($messages, [$prompt]);
        $response = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => $messagesWithInstruction,
        ]);

        if (!empty($response->choices)) {
            return end($response->choices)->message->content ?? 'New Chat';
        }

        return 'New Chat';
    }
}
