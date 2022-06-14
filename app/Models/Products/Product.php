<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relationships
    public function product_category()
    {
        return $this->belongsTo('App\Models\Products\ProductCategory');
    }
}
