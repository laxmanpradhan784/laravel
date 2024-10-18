<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    // Specify the table if it's not the plural of the model name
    protected $table = 'contacts'; // Ensure this matches your database table name

    // Define the fillable properties
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
    ];

    // Optionally, set the timestamps if needed
    public $timestamps = true; // Or false if you don't have created_at/updated_at fields
}
