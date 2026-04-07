<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Subcategory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'status',
        'showHome'
    ];

    public function subCategories()
    {
        return $this->hasMany(Subcategory::class, 'category_id');
    }
}