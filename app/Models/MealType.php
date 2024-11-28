<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealType extends Model
{
    use HasFactory;

    public function dayRecipes()
    {
        return $this->hasMany(DayRecipe::class, 'meal_type_id');  // Un tipo de comida puede tener muchas recetas asociadas
    }
}
