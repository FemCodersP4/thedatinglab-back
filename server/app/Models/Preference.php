<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Preference extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'birthdate',
        'gender',
        'looksFor',
        'ageRange',
        'sexoAffective',
        'heartState',
        'values1',
        'values2',
        'values3',
        'preferences1',
        'preferences2',
        'catsDogs',
 
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function user() {
        return $this->hasOne(User::class, 'preference_id');
    }

}
