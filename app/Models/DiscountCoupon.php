<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscountCoupon extends Model
{
    protected $fillable = [
        'code',
        'description',
        'max_uses',
        'type',
        'discount_amount',
        'status',
        'starts_at',
        'expires_at'
    ];
}