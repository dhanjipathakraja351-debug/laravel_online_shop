<?php

use App\Models\Category;

if (!function_exists('getCategories')) {

    function getCategories()
    {
        return Category::where('showHome', 1)
            ->orderBy('name', 'ASC')
            ->where('status',1)
            ->get();
    }

}