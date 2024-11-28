<?php

namespace App\Livewire\Diet;

use Livewire\Component;

class MealCardComponent extends Component
{
    public $title;
    public $calories;
    public $protein;
    public $fat;
    public $carbs;
    public $dishName;
    public $ingredients;
    public $preparation;
    public $healthBenefits;

    public function render()
    {
        return view('livewire.diet.meal-card-component');
    }
}
