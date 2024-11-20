<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Muscle extends Model
{
    use HasFactory;

    //pertenece a muchos
    public function ejercicios(){
        return $this->belongsToMany(Ejercicio::class,'EjercicoMusculo');
    }
}
