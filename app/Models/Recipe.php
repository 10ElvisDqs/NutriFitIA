<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    // Asegúrate de que los campos sean parte de la propiedad $fillable
    protected $fillable = [
        'name',
        'ingredients',
        'preparation',
        'benefits',
        'duration',
        'image_url',
        'video_url',
    ];

    // Relación con la tabla `day_recipe`
    public function dayRecipes()
    {
        return $this->hasMany(DayRecipe::class, 'recipe_id');  // Una receta puede estar asociada a varios días
    }
}
