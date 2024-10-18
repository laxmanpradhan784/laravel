<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products'; // Specify the table name if not following Laravel conventions
    protected $primaryKey = 'ProductID'; // Set the primary key
    public $timestamps = true; // Enable timestamps

    protected $fillable = [
        'Name',
        'Description',
        'Image',
        'Price',
        'Status',
        'CategoryID',
        'StockQuantity',
        'Size',
        'Color',
        'Rating',
        'DiscountPercentage',
        'MetaDescription',
        'MetaKeywords',
        'IsFeatured',
    ];

    // Relationship with the Category model
    public function category()
    {
        return $this->belongsTo(Category::class, 'CategoryID', 'CategoryID');
    }

    // Relationship with the Review model
    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id', 'ProductID'); // Adjust based on your actual foreign key
    }

    // Custom accessor for formatted price
    public function getFormattedPriceAttribute()
    {
        return number_format($this->Price, 2); // Returns the price formatted as a string
    }

    // Validation rules for product creation/updating
    public static function rules($id = null)
    {
        return [
            'Name' => 'required|string|max:255',
            'Description' => 'required|string',
            'Image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'Price' => 'required|numeric|min:0',
            'Status' => 'required|in:active,inactive',
            'StockQuantity' => 'required|integer|min:0',
            'Size' => 'nullable|string|max:50',
            'Color' => 'nullable|string|max:50',
            'Rating' => 'nullable|numeric|min:0|max:5',
            'DiscountPercentage' => 'nullable|numeric|min:0|max:100',
            'MetaDescription' => 'nullable|string',
            'MetaKeywords' => 'nullable|string',
            'IsFeatured' => 'boolean',
        ];
    }
}
