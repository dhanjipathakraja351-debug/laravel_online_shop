<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Review extends Model
{
    protected $fillable = [
        'product_id',
        'name',
        'email',
        'rating',
        'comment',
        'status'
    ];

    // ✅ ADD THIS
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}