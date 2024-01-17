<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    protected $fillable = [
        'name',
        'url',
        'price',
        'old_price',
        'currencyId',
        'category_id',
        'picture',
        'vendor',
        'available',
        'good_id',
    ];
}
