<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ConditionType;

class ConditionTypeCrud extends Component
{
    public $conditionTypes, $name, $conditionTypeId;
    public $isOpen = false;

    public function render()
    {
        $this->conditionTypes = ConditionType::all();
        return view('livewire.condition-type-crud');
    }

    // Mostrar formulario de creación/edición
    public function openForm($id = null)
    {
        $this->isOpen = true;

        if ($id) {
            $conditionType = ConditionType::find($id);
            $this->conditionTypeId = $conditionType->id;
            $this->name = $conditionType->name;
        } else {
            $this->resetForm();
        }
    }

    // Cerrar formulario
    public function closeForm()
    {
        $this->isOpen = false;
        $this->resetForm();
    }

    // Guardar o actualizar un tipo de condición
    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
        ]);

        ConditionType::updateOrCreate(
            ['id' => $this->conditionTypeId],
            ['name' => $this->name]
        );

        $this->closeForm();
        session()->flash('message', 'Condición guardada correctamente.');
    }

    // Eliminar tipo de condición
    public function delete($id)
    {
        ConditionType::find($id)->delete();
        session()->flash('message', 'Condición eliminada correctamente.');
    }

    // Restablecer formulario
    private function resetForm()
    {
        $this->name = '';
        $this->conditionTypeId = null;
    }
}
