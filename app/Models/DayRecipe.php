<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayRecipe extends Model
{
    use HasFactory;
    protected $fillable = [
        'day_id',
        'recipe_id',
        'meal_type_id',
        'completed'
    ];

    // Definir las relaciones con las otras tablas

    // Relación con la tabla `days`
    public function day()
    {
        return $this->belongsTo(Day::class, 'day_id');  // Relación inversa con `days`
    }

    // Relación con la tabla `recipes`
    public function recipe()
    {
        return $this->belongsTo(Recipe::class, 'recipe_id');  // Relación inversa con `recipes`
    }

    // Relación con la tabla `meal_types`
    public function mealType()
    {
        return $this->belongsTo(MealType::class, 'meal_type_id');  // Relación inversa con `meal_types`
    }
}
