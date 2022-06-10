<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMonitoring extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relationships
    public function product()
    {
        return $this->belongsTo('App\Models\Products\Product');
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Orders\Order');
    }
}
