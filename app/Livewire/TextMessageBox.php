<?php

namespace App\Livewire;

use Livewire\Component;

class TextMessageBox extends Component
{
    public string $placeholder = '';
    public bool $disableCorrections = false;
    public string $prompt = '';

    protected $rules = [
        'prompt' => 'required|string',
    ];

    public function handleSubmit()
    {
        $this->validate();

        // Emitimos el evento con el mensaje
        // $this->emit('onMessage', $this->prompt);
        $this->emit('messageSent', $this->prompt); // Cambiado a 'messageSent' para asegurar que coincide con la escucha en tu plantilla.
        // Limpiamos el campo de entrada
        $this->reset('prompt');
    }

    public function render()
    {
        return view('livewire.text-message-box');
    }
}
