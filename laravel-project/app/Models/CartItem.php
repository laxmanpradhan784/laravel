<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'product_name',  // Corrected to match your database column
        'product_image',  // Corrected to match your database column
        'subtotal',       // Add subtotal to fillable
    ];
}
