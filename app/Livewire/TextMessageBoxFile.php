<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class TextMessageBoxFile extends Component
{
    use WithFileUploads;

    public $prompt;
    public $file;
    public $placeholder = '';

    protected $rules = [
        'prompt' => 'nullable|string',
        'file' => 'required|file|max:10240', // ajusta el tamaño máximo si es necesario
    ];

    public function updatedFile()
    {
        $this->validateOnly('file');
    }

    public function handleSubmit()
    {
        $this->validate();

        if (!empty($this->prompt)) {
            // Emitimos el evento con el mensaje
            $this->emit('messageSent', $this->prompt);

            // Limpiamos el campo de entrada
            $this->reset('prompt');
        }
    }

    public function render()
    {
        return view('livewire.text-message-box-file');
    }
}
