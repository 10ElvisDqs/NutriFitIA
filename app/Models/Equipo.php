<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;
    public function ejercicios(){
        return $this->belongsToMany(Ejercicio::class,'ejercicio_equipos');
    }
}
