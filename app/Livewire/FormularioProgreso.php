<?php

namespace App\Livewire;

use App\Models\AnthropometricMeasurement;
use App\Models\Consultation;
use App\Models\TargetType;
use App\Models\MedicalCondition;
use Livewire\Component;

class FormularioProgreso extends Component
{
    public $paso = 1;

    // Variables para los datos del formulario
    public $patient_id; // Suponemos que el paciente está autenticado
    public $target_type_id;
    public $weight;
    public $height;
    public $physical_activity_level;
    public $dietary_preference;
    public $restrictions;

    public $bmi; // Calculado automáticamente

    protected $rules = [
        'target_type_id' => 'required|exists:target_types,target_type_id',
        'weight' => 'required|numeric|min:1',
        'height' => 'required|numeric|min:1',
        'physical_activity_level' => 'required|string',
        'dietary_preference' => 'nullable|string',
        'restrictions' => 'nullable|string',
    ];

    public function avanzar()
    {
        $this->validateCurrentStep();
        if ($this->paso < 3) {
            $this->paso++;
        }
    }

    public function retroceder()
    {
        if ($this->paso > 1) {
            $this->paso--;
        }
    }

    public function calcularBmi()
    {
        if ($this->weight && $this->height) {
            $this->bmi = $this->weight / (($this->height / 100) ** 2); // Altura en metros
        }
    }

    public function guardar()
    {
        $this->validate();

        // Guardar en la tabla `anthropometric_measurements`
        $anthropometricMeasurement = AnthropometricMeasurement::create([
            'weight' => $this->weight,
            'height' => $this->height,
            'bmi' => $this->bmi,
            'patient_id' => $this->patient_id,
        ]);

        // Guardar en la tabla `consultations`
        Consultation::create([
            'patient_id' => $this->patient_id,
            'target_type_id' => $this->target_type_id,
            'anthropometric_measurement_id' => $anthropometricMeasurement->id,
            'date' => now(),
            'dietary_preference' => $this->dietary_preference,
            'physical_activity_level' => $this->physical_activity_level,
            'restrictions' => $this->restrictions,
        ]);

        // Reiniciar el formulario o redirigir al usuario
        session()->flash('message', 'Consulta registrada exitosamente.');
        $this->reset();
        $this->paso = 1;
    }

    private function validateCurrentStep()
    {
        if ($this->paso === 1) {
            $this->validate(['target_type_id' => 'required|exists:target_types,target_type_id']);
        } elseif ($this->paso === 2) {
            $this->validate([
                'weight' => 'required|numeric|min:1',
                'height' => 'required|numeric|min:1',
            ]);
            $this->calcularBmi();
        }
    }

    public function render()
    {
        $targetTypes = TargetType::all();
        $medicalCondition = MedicalCondition::all();
        return view('livewire.formulario-progreso', compact('targetTypes','medicalCondition'));
    }
}
