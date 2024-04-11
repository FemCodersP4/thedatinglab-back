<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'password',
        'preference_id',
        'profile_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function profile() {
    return $this->belongsTo(Profile::class, 'profile_id');
}

public function preference() {
    return $this->belongsTo(Preference::class, 'preference_id');
}

public static function findMatchesForUser($user)
{
    try {
        return self::whereHas('preference', function ($query) use ($user) {
            $query->where('ageRange', $user->preference->ageRange)
                ->where(function ($query) use ($user) {
                    if ($user->preference->looksFor === 'mujer') {
                        $query->where('gender', 'mujer');

                    } elseif ($user->preference->looksFor === 'hombre') {
                        $query->where('gender', 'hombre');

                    } elseif ($user->preference->looksFor === 'todo') {
                        $query->where('gender', 'hombre')
                            ->orWhere('gender', 'mujer')
                            ->orWhere('gender', 'no binario');

                    } elseif ($user->preference->looksFor === 'no binario') {
                        $query->where('gender', 'no binario');
                    }
                });
        })
        ->where('id', '!=', $user->id)
        ->get();
    } catch (\Exception $e) {
        throw new \RuntimeException("Error al encontrar coincidencias para el usuario: " . $e->getMessage());
    }
}

    public function confirmAttendance()
{
    return $this->belongsToMany(Event::class);
}

}
