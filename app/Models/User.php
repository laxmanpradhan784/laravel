<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
        'dob',
        'gender',
    ];

    protected $dates = [
        'dob', // Automatically cast 'dob' to a Carbon instance
    ];

    // Mutator to hash password when creating/updating a user
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    // Accessor for getting the user's age
    public function getAgeAttribute()
    {
        return $this->dob ? $this->dob->diffInYears(now()) : null;
    }

    // Example: Accessor for full name if you have first and last name fields
    public function getFullNameAttribute()
    {
        return "{$this->name}";
    }

    // Optional: Relationship methods can be added here
    // e.g., posts(), comments() if you have related models
}
