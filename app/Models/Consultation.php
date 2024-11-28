<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;
    protected $primaryKey = 'consultation_id';

    protected $fillable = [
        'patient_id',
        'target_type_id',
        'anthropometric_measurement_id',
        'date',
        'dietary_preference',
        'physical_activity_level',
        'restrictions',
    ];

    // Relación con pacientes
    public function user()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    // Relación con tipo de objetivo
    public function targetType()
    {
        return $this->belongsTo(TargetType::class, 'target_type_id');
    }

    // Relación con medidas antropométricas
    public function anthropometricMeasurement()
    {
        return $this->belongsTo(AnthropometricMeasurement::class, 'anthropometric_measurement_id');
    }

    public function iaRecommendations()
    {
        return $this->hasMany(IaRecommendation::class, 'consultation_id');
    }

    public function diets()
    {
        return $this->hasMany(Diet::class, 'consultation_id');
    }
}
