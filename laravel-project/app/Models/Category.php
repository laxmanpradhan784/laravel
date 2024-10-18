<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories'; // Specify the table name if it doesn't follow Laravel's naming convention

    protected $primaryKey = 'CategoryID'; // Specify the primary key

    public $timestamps = false; // Disable timestamps if you don't have created_at and updated_at columns

    protected $fillable = [
        'CategoryName',
        'ParentCategoryID',
    ];

    // Define relationships, if needed
    public function parent()
    {
        return $this->belongsTo(Category::class, 'ParentCategoryID');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'ParentCategoryID');
    }
}
