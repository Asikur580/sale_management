<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockInOut extends Model
{
    protected $fillable = [
        'product_id',
        'quantity',
        'in_out',
        'purpose',
        'taken_by',
        'in_out_date',
    ];

    /**
     * Get the product that owns the stock movement.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
}
