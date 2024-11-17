<?php

namespace App\Livewire;

use Livewire\Component;

class MyMessage extends Component
{
    public string $text;
    public function render()
    {
        return view('livewire.my-message');
    }
}
