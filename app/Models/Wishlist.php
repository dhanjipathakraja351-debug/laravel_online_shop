<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $fillable = [
        'user_id',
        'product_id'
    ];

    // ✅ Relation with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ✅ Relation with Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}