<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UserDashboard extends Component
{
    public $user;
    public $message = "¡Bienvenido a NutriFitIA!";
    public $displayText = "";

    public function mount()
    {
        // Obtener el usuario autenticado
        $this->user = Auth::user();
    }

    public function updated()
    {
        $this->typingEffect();
    }

    // Simulación de efecto de escritura
    public function typingEffect()
    {
        $this->dispatch('start-typing-effect');
    }
    public function render()
    {
        return view('livewire.user-dashboard');
    }
}
