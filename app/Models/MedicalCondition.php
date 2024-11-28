<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalCondition extends Model
{
    use HasFactory;
    protected $primaryKey = 'condition_id'; // Especificar la clave primaria personalizada

    protected $fillable = [
        'name',
        'condition_type_id',
    ];

    public function conditionType()
    {
        return $this->belongsTo(ConditionType::class, 'condition_type_id','id');
    }

    public function users()
    {
        return $this->belongsToMany(
            User::class,               // Modelo relacionado
            'patient_condition',          // Nombre de la tabla intermedia
            'condition_id',               // Clave foránea en la tabla intermedia que apunta a este modelo
            'patient_id'                  // Clave foránea en la tabla intermedia que apunta al modelo relacionado
        )->withTimestamps();              // Incluye timestamps si están en la tabla intermedia
    }

    // Relación con la tabla intermedia 'patient_condition'
    public function patientConditions()
    {
        return $this->hasMany(PatientCondition::class, 'condition_id');
    }

}
