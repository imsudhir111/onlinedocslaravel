<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    //Step 2 : Created Doctor model
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'age',
        'mobile',
        'photo',
        'gender',
        'highest_education',
        'experience',
        'address',
        'state_id',
        'city_id',
        'working_days',
        'day_from_time',
        'day_to_time',
        'night_from_time',
        'night_to_time',
        'zoom_gmail_id',
        'zoom_gmail_password',
        'zoom_api_key',
        'zoom_api_secret_key',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
