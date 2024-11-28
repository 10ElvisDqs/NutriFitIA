<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\MedicalCondition;
use App\Models\ConditionType;
use Livewire\WithPagination;

class MedicalConditions extends Component
{
    use WithPagination;

    public $name;
    public $condition_type_id;
    public $selected_id;
    public $updateMode = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'condition_type_id' => 'required|exists:condition_types,id',
    ];

    /**
     * Personalizar la paginación para evitar recarga.
     */
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $medicalConditions = MedicalCondition::with('conditionType')->paginate(10);

        return view('livewire.medical-conditions', [
            'medicalConditions' => $medicalConditions,
        ]);
    }

    public function resetInputFields()
    {
        $this->name = '';
        $this->condition_type_id = '';
        $this->selected_id = null;
        $this->updateMode = false;
    }

    public function store()
    {
        $this->validate();

        MedicalCondition::create([
            'name' => $this->name,
            'condition_type_id' => $this->condition_type_id,
        ]);

        session()->flash('message', 'Condition created successfully.');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $record = MedicalCondition::findOrFail($id);
        $this->selected_id = $id;
        $this->name = $record->name;
        $this->condition_type_id = $record->condition_type_id;
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate();

        if ($this->selected_id) {
            $record = MedicalCondition::find($this->selected_id);
            $record->update([
                'name' => $this->name,
                'condition_type_id' => $this->condition_type_id,
            ]);

            session()->flash('message', 'Condition updated successfully.');
            $this->resetInputFields();
        }
    }

    public function delete($id)
    {
        MedicalCondition::destroy($id);
        session()->flash('message', 'Condition deleted successfully.');
    }
}
