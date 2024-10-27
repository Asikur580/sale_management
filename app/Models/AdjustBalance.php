<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdjustBalance extends Model
{
    protected $fillable = [
        'balance_plus',
        'balance_minus',
    ];
}
