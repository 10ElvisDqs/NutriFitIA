<?php

namespace App\Livewire\Diet;

use Livewire\Component;

class NavarDiet extends Component
{
    // Propiedades para cada sección
    public $activeSection = 'dieta';  // Sección activa por defecto
    public $nombreDieta;
    public $recetas;

    // Cambiar la sección activa
    public function setActiveSection($section)
    {
        $this->activeSection = $section;
    }



    public function render()
    {
        return view('livewire.diet.navar-diet');
    }
}
