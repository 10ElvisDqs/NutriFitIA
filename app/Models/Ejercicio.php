<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ejercicio extends Model
{
    use HasFactory;
    //protected $fillable = ['nombre', 'descripcion', 'videoPath', 'dificultad', 'tipoEjercicioId'];
    public function tipo_ejercicios(){
        return $this->belongsTo(tipo_ejercicio::class,'tipoEjercicioId');
    }
    public function muscles(){
        return $this->belongsToMany(Muscle::class,'ejercicio_musculos');
    }
    public function equipos(){
        return $this->belongsToMany(Equipo::class,'ejercicio_equipos');
    }
}

