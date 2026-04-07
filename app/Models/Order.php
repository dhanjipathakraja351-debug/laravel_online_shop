<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'subtotal',
        'shipping',
        'coupon_code',
        'discount',
        'grand_total',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'country',
        'zip'
    ];

    // ✅ Required for Order List & Detail page
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    // ✅ Required for Order Detail page (products)
    public function orderItems()
    {
        return $this->hasMany(\App\Models\OrderItem::class);
    }
}