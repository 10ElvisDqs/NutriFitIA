<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientCondition extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_id',
        'condition_id',
    ];
    // Definir la relación con el modelo User (paciente)
    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    // Definir la relación con el modelo MedicalCondition
    public function condition()
    {
        return $this->belongsTo(MedicalCondition::class, 'condition_id');
    }
}
