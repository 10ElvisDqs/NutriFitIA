<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diet extends Model
{
    use HasFactory;

    // Relación inversa con IARecommendation (si existe)
    public function recommendation()
    {
        return $this->belongsTo(IARecommendation::class, 'recommendation_ia_id');
    }

    // Relación inversa: una dieta pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function days()
    {
        return $this->hasMany(Day::class);
    }
}
