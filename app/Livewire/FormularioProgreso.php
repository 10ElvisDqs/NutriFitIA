<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Question;

class FormularioProgreso extends Component
{
    public $preguntasPorGrupo = 5;
    public $grupoActual = 1;
    public $respuestas = [];
    public $totalGrupos;

    public function mount()
    {
        $totalPreguntas = Question::count();
        $this->totalGrupos = ceil($totalPreguntas / $this->preguntasPorGrupo);
    }
    public function avanzarGrupo()
    {
        $this->grupoActual++;

        if ($this->grupoActual > $this->totalGrupos) {
            // Guardar todas las respuestas en la base de datos o procesarlas
            session()->flash('message', '¡Formulario completado!');
            return redirect()->route('formulario.completado');
        }
    }
    public function render()
    {
        $preguntas = Question::orderBy('id')
            ->skip(($this->grupoActual - 1) * $this->preguntasPorGrupo)
            ->take($this->preguntasPorGrupo)
            ->get();
        return view('livewire.formulario-progreso',compact('preguntas'));
    }
}
