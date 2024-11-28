<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IaRecommendation extends Model
{
    use HasFactory;

    protected $table = 'ia_recommendations';

    protected $primaryKey = 'recommendation_ia_id';

    protected $fillable = [
        'description', 'date', 'type', 'consultation_id'
    ];

    public function consultation()
    {
        return $this->belongsTo(Consultation::class, 'consultation_id');
    }

    // Relación uno a muchos con Dieta
    public function diets()
    {
        return $this->hasMany(Diet::class, 'recommendation_ia_id');
    }
}
