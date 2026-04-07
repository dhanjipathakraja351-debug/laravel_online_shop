<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'price',
        'compare_price',
        'category_id',
        'sub_category_id',
        'brand_id',
        'status',
        'is_featured',
        'sku',
        'track_qty',
        'qty',
        'image'
    ];

    // ===== RELATIONSHIPS =====

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(Subcategory::class, 'sub_category_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function product_images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function reviews()
    {
    return $this->hasMany(Review::class);
    }
}