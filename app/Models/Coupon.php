<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code',
        'discount_type',
        'discount_amount',
        'maximum_discount_amount',
        'minimum_total_price',
        'maximum_num_of_items',
        'minimum_num_of_items',
        'allowed_product_id',
        'max_uses_system',
        'max_uses_user',
        'coupon_type',
        'expiry_date',
    ];

    protected $casts = [
        'expiry_date' => 'datetime',
    ];
}
