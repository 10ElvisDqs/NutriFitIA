<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnthropometricMeasurement extends Model
{
    use HasFactory;
    // Campos que se pueden llenar masivamente
    protected $fillable = [
        'weight',
        'height',
        'bmi',
        'patient_id'
    ];



    /**
     * Relación con el modelo User (paciente)
     */
    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function consultation()
    {
        return $this->hasOne(Consultation::class, 'anthropometric_measurement_id');
    }

}
