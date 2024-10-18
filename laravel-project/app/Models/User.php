<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    // The attributes that are mass assignable.
    protected $fillable = [
        'name', 'email', 'mobile', 'dob', 'gender', 'password', 'image', // Added 'image'
    ];

    // The attributes that should be hidden for arrays.
    protected $hidden = [
        'password', 'remember_token',
    ];

    // The attributes that should be cast to native types.
    protected $casts = [
        'email_verified_at' => 'datetime',
        'dob' => 'date',
    ];

    // Automatically hash the password when setting it
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    // Optionally, you can add relationships or custom methods here
}
