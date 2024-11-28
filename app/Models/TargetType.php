<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetType extends Model
{
    use HasFactory;
    protected $primaryKey = 'target_type_id';
    protected $fillable = ['name'];

    public function consultations()
    {
        return $this->hasMany(Consultation::class, 'target_type_id');
    }
}
