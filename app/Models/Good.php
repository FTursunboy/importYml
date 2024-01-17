<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
