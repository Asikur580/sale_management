<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'cat_id',
        'brand_id',
        'model',
        'serial',
        'warranty',
        'purchese_form',
        'buy_price',
        'sell_price',
        'quantity',
    ];

    /**
     * Get the category that the product belongs to.
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }

    /**
     * Get the brand that the product belongs to.
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
}
