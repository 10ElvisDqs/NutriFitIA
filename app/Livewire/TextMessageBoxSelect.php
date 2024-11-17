<?php

namespace App\Livewire;

use Livewire\Component;

class TextMessageBoxSelect extends Component
{
    public $placeholder = '';
    public $options = [];
    public $prompt = '';
    public $selectedOption = '';

    // Reglas de validación para los campos
    protected $rules = [
        'prompt' => 'required|string',
        'selectedOption' => 'required|string',
    ];

    public function mount($placeholder, $options)
    {
        $this->placeholder = $placeholder;
        $this->options = $options;
    }

    public function handleSubmit()
    {
        $this->validate();

        // Emitir el evento 'onMessage' con los datos de entrada
        $this->emit('onMessage', [
            'prompt' => $this->prompt,
            'selectedOption' => $this->selectedOption
        ]);

        // Resetear los campos del formulario
        $this->prompt = '';
        $this->selectedOption = '';
    }

    public function render()
    {
        return view('livewire.text-message-box-select');
    }
}
