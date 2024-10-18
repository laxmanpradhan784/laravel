<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews'; // Specify the table name if different from the default
    public $timestamps = true; // Enable timestamps

    protected $fillable = [
        'product_id', // Foreign key
        'user_id',    // Assuming you have a user associated with the review
        'rating',
        'comment',
    ];

    // Define the relationship with Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'ProductID');
    }

    // Define the relationship with User (if applicable)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
