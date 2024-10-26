<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'name',
    ];

     /**
     * Get the products for the brand.
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id');
    }
}
