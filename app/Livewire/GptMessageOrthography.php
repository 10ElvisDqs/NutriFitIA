<?php

namespace App\Livewire;

use Livewire\Component;

class GptMessageOrthography extends Component
{
    public int $userScore;
    public string $text;
    public array $errors = [];
    public function render()
    {
        return view('livewire.gpt-message-orthography');
    }
}
