<?php
namespace App\Services;

use OpenAI\Laravel\Facades\OpenAI;

class OpenAIService
{
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
