<?php

namespace App\Services\SamAssistant;

use OpenAI\Client as OpenAIClient;

class SamAssistantService
{
    protected $openai;

    public function __construct(OpenAIClient $openai)
    {
        $this->openai = $openai;
    }

    public function createThread()
    {
        $response = $this->openai->threads()->create();
        return ['id' => $response['id']];
    }

    public function userQuestion(array $questionDto)
    {
        $threadId = $questionDto['threadId'];
        $question = $questionDto['question'];

        $message = $this->openai->threads()->messages->create($threadId, [
            'role' => 'user',
            'content' => $question,
        ]);

        $response = $this->openai->threads()->runs->create($threadId, [
            'assistant_id' => 'asst_12345',
        ]);

        return $response;
    }
}
