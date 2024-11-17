<?php

namespace App\Livewire\Pages;

use App\Services\OpenAIService;
use Livewire\Component;

use App\Models\Conversation;
use App\Models\Message;
use Spatie\LaravelMarkdown\MarkdownRenderer;

class AssistantPage extends Component
{
    public Conversation $conversation;
    public $messages = [];
    public $isLoading = false;
    public $threadId;

    protected $listeners = ['handleMessage'];

    public function mount()
    {
        // $this->initializeThread();

        // $this->loadMessages();
    }

    public function loadMessages(): void
    {
        $this->messages = $this->conversation->messages()->oldest()->get()->map(function (Message $message) {
            $message->content = app(MarkdownRenderer::class)
                ->highlightTheme('github-dark')
                ->toHtml($message->content);

            return $message;
        });
    }


    public function initializeThread()
    {
        $openAiService = app(OpenAIService::class);
        // $this->threadId = $openAiService->createThread();
    }

    public function handleMessage($question)
    {
        $this->isLoading = true;

        // Agrega el mensaje del usuario a la lista de mensajes
        $this->messages[] = [
            'text' => $question,
            'isGpt' => false,
        ];

        // Llama al servicio de OpenAI para obtener una respuesta
        $openAiService = app(OpenAiService::class);
        $replies = $openAiService->postQuestion($this->threadId, $question);

        // Agrega las respuestas del asistente
        foreach ($replies as $reply) {
            foreach ($reply['content'] as $message) {
                $this->messages[] = [
                    'text' => $message,
                    'isGpt' => $reply['role'] === 'assistant',
                ];
            }
        }

        $this->isLoading = false;
    }

    public function render()
    {
        // $this->messages = Message::all();
        // // dd($this->messages );
        // return view('livewire.pages.assistant-page', [
        //     'messages' => $this->messages,
        //     'isLoading' => $this->isLoading,
        // ]);


        // Obtén los mensajes de la conversación correspondiente
        $conversation = Conversation::find(20);  // Suponiendo que tienes el `threadId` de la conversación
        $this->messages = $conversation ? $conversation->messages : [];
        // dd($conversation);
        if ($conversation) {
            $this->messages = $conversation->messages; // Obtiene los mensajes de esa conversación
        } else {
            $this->messages = []; // Si no se encuentra la conversación, inicializa como vacío
        }


        return view('livewire.pages.assistant-page', [
            'messages' => $this->messages,
            'isLoading' => $this->isLoading,
        ]);
    }

}
