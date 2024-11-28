<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;
    // Agregar diet_id a la propiedad $fillable
    protected $fillable = [
        'diet_id',   // Asegúrate de agregar diet_id
        'name',
        'date',
    ];

    public function diet()
    {
        return $this->belongsTo(Diet::class);
    }

    // Relación con la tabla `day_recipe`
    public function dayRecipes()
    {
        return $this->hasMany(DayRecipe::class, 'day_id');  // Un día tiene muchas recetas asociadas
    }
}
