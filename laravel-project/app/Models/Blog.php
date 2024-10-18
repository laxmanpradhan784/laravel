<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    // Specify which fields are mass assignable
    protected $fillable = [
        'title',
        'image',
        'author',
        'content',
        'status',
    ];

    // If you want to use guarded (example: you want to guard some columns)
    // protected $guarded = ['id']; 
}
