<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderSummary extends Model
{
    use HasFactory;

    protected $table = 'orders'; // Table name

    protected $fillable = [
        'user_id',
        'address',
        'city',
        'postal_code',
        'status', // e.g., 'pending', 'completed'
        
    ];

    // Define relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'order_summary_id'); // Assuming CartItem model exists
    }
}
