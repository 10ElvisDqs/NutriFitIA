<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\OpenAiService; // Asegúrate de tener este servicio configurado correctamente


class OrthographyPage extends Component
{
    public $messages = [];
    public $isLoading = false;

    protected $listeners = ['messageSent' => 'handleMessage'];

    protected $openAiService;

    public function __construct()
    {
        // Inyectar el servicio
        $this->openAiService = app(OpenAiService::class);
    }

    public function handleMessage($prompt)
    {
        $this->isLoading = true;

        $this->messages[] = [
            'isGpt' => false,
            'text' => $prompt
        ];

        // Llamar al servicio para obtener la respuesta
        $response = $this->openAiService->checkOrthography($prompt);

        $this->isLoading = false;

        $this->messages[] = [
            'isGpt' => true,
            'text' => $response['message'],
            'info' => $response
        ];
    }

    public function render()
    {
        return view('livewire.orthography-page');
    }
}
