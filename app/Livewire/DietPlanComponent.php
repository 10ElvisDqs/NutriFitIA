<?php

namespace App\Livewire;
use App\Jobs\GenerarPlanYRecetas;

use Livewire\Component;

class DietPlanComponent extends Component
{

    public $statusMessage = 'Esperando...';

    protected $listeners = ['planDeDietaGenerado' => 'actualizarPlanDieta'];

    public function actualizarPlanDieta($diet)
    {
        $this->statusMessage = 'Plan de dieta generado: ' . $diet['name'];
    }
    public function generarPlanDeDieta($dietData)
    {
        $this->statusMessage = 'Generando plan de dieta...';

        // Despachar el Job en segundo plano
        GenerarPlanYRecetas::dispatch($dietData, auth()->id(), 7);

        // Otras tareas si es necesario
        // Notificar que el proceso ha comenzado
        session()->flash('message', 'El proceso de generación de dieta ha comenzado.');
    }

    public function render()
    {
        return view('livewire.diet-plan-component');
    }
}
