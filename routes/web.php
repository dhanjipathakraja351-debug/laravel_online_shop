<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TempImagesController;
use App\Http\Controllers\Admin\Subcategorycontroller;
use App\Http\Controllers\Admin\BrandsController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductSubCategoryController;
use App\Http\Controllers\FrontController;
//i am learning git and this is my second commit

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

 //Redirect root to admin login
Route::get('/', function () {
    return redirect()->route('admin.login');
});

Route::prefix('admin')->name('admin.')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Guest Admin Routes
    |--------------------------------------------------------------------------
    */

    Route::middleware('guest:admin')->group(function () {

        Route::get('/login', [AdminLoginController::class, 'index'])
            ->name('login');

        Route::post('/authenticate', [AdminLoginController::class, 'authenticate'])
            ->name('authenticate');
    });

    Route::get('/',[FrontController::class,'index'])->name('front.home');

    /*
    |--------------------------------------------------------------------------
    | Authenticated Admin Routes
    |--------------------------------------------------------------------------
    */

    Route::middleware('auth:admin')->group(function () {

    Route::post('product-images', [ProductController::class,'storeProductImage'])
        ->name('product-images.store');

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [HomeController::class, 'index'])
        ->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | Category Routes
        |--------------------------------------------------------------------------
        */

        Route::get('/categories', [CategoryController::class, 'index'])
            ->name('categories.index');

        Route::get('/categories/create', [CategoryController::class, 'create'])
            ->name('categories.create');

        Route::post('/categories', [CategoryController::class, 'store'])
            ->name('categories.store');

        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])
            ->name('categories.edit');

        Route::put('/categories/{category}', [CategoryController::class, 'update'])
            ->name('categories.update');

        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])
            ->name('categories.destroy');


        /*
        |--------------------------------------------------------------------------
        | Sub Category Routes
        |--------------------------------------------------------------------------
        */

        Route::get('/sub-categories', [Subcategorycontroller::class, 'index'])
            ->name('sub-categories.index');

        Route::get('/sub-categories/create', [Subcategorycontroller::class, 'create'])
            ->name('sub-categories.create');

        Route::post('/sub-categories', [Subcategorycontroller::class, 'store'])
            ->name('sub-categories.store');

        Route::get('/sub-categories/{subcategory}/edit', [Subcategorycontroller::class, 'edit'])
            ->name('sub-categories.edit');

        Route::put('/sub-categories/{subcategory}', [Subcategorycontroller::class, 'update'])
            ->name('sub-categories.update');

        Route::delete('/sub-categories/{subcategory}', [Subcategorycontroller::class, 'destroy'])
            ->name('sub-categories.destroy');


        /*
        |--------------------------------------------------------------------------
        | Brands Routes
        |--------------------------------------------------------------------------
        */

        Route::get('/brands', [BrandsController::class, 'index'])
            ->name('brands.index');

        Route::get('/brands/create', [BrandsController::class, 'create'])
            ->name('brands.create');

        Route::post('/brands', [BrandsController::class, 'store'])
            ->name('brands.store');

        Route::get('/brands/{brand}/edit', [BrandsController::class, 'edit'])
            ->name('brands.edit');

        Route::put('/brands/{brand}', [BrandsController::class, 'update'])
            ->name('brands.update');

        Route::delete('/brands/{brand}', [BrandsController::class, 'destroy'])
            ->name('brands.destroy');


        /*
        |--------------------------------------------------------------------------
        | Product Routes
        |--------------------------------------------------------------------------
        */

        Route::get('/products', [ProductController::class, 'index'])
            ->name('products.index');

        Route::get('/products/create', [ProductController::class, 'create'])
            ->name('products.create');

        Route::post('/products', [ProductController::class, 'store'])
            ->name('products.store');

        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])
            ->name('products.edit');

        Route::put('/products/{product}', [ProductController::class, 'update'])
            ->name('products.update');

        Route::delete('/products/{product}', [ProductController::class, 'destroy'])
            ->name('products.destroy');


        /*
        |--------------------------------------------------------------------------
        | TEMP IMAGE UPLOAD (DROPZONE)
        |--------------------------------------------------------------------------
        */

        Route::post('/temp-images', [TempImagesController::class, 'create'])
            ->name('temp-images.create');


        /*
        |--------------------------------------------------------------------------
        | AJAX SubCategory Route (FOR PRODUCT PAGE)
        |--------------------------------------------------------------------------
        */

        Route::get('/get-subcategories', [ProductSubCategoryController::class, 'index'])
            ->name('subcategories');


        /*
        |--------------------------------------------------------------------------
        | Slug Generator
        |--------------------------------------------------------------------------
        */

        Route::get('/getslug', function (Request $request) {

            $slug = '';

            if (!empty($request->title)) {
                $slug = Str::slug($request->title);
            }

            return response()->json([
                'status' => true,
                'slug'   => $slug
            ]);

        })->name('getSlug');


        /*
        |--------------------------------------------------------------------------
        | Logout
        |--------------------------------------------------------------------------
        */

        Route::post('/logout', [AdminLoginController::class, 'logout'])
            ->name('logout');

    });

});