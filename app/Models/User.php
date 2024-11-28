<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    protected $primaryKey = 'id'; // Especificar la clave primaria personalizada
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function adminlte_image()
    {
        // return $this->profile_image ? asset('storage/' . $this->profile_image) : asset('vendor/adminlte/dist/img/user2-160x160.jpg');
        return 'C:\Proyectos\Nutri-IA\api-nutricional-ia\public\vendor\adminlte\dist\img\logoNutiFitIA.png';
    }

    public function conversations(): HasMany
    {
        return $this->hasMany(Conversation::class);
    }

    public function conditions()
    {
        return $this->hasMany(PatientCondition::class, 'patient_id');
    }

    public function consultations()
    {
        return $this->hasMany(Consultation::class, 'patient_id');
    }

    /**
     * Relación con el modelo AnthropometricMeasurement
     */
    public function anthropometricMeasurements()
    {
        return $this->hasMany(AnthropometricMeasurement::class, 'patient_id');
    }

    // Relación uno a muchos con Diet
    public function diets()
    {
        return $this->hasMany(Diet::class);
    }

}
