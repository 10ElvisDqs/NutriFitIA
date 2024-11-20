<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipo_ejercicio extends Model
{
    use HasFactory;
    public function Ejercicios(){
        return $this->hasMany(Ejercicio::class,'id');
    }
}
