<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs'; // Specify the table name if it doesn't follow Laravel's naming convention

    protected $fillable = [
        'title',
        'author',
        'image',
        'content',
        'status',
    ];

    // Optionally, you can add casts if you have specific data types
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
