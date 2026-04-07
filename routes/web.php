<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TempImagesController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\BrandsController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductSubCategoryController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Admin\DiscountCodeController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\Admin\ReviewController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Frontend Home
Route::get('/', [FrontController::class,'index'])->name('front.home');
Route::get('/page/{slug}', [FrontController::class, 'page'])->name('front.page');


Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('guest:admin')->group(function () {

        Route::get('/login', [AdminLoginController::class, 'index'])
            ->name('login');

        Route::post('/authenticate', [AdminLoginController::class, 'authenticate'])
            ->name('authenticate');
            
    });

    Route::middleware('auth:admin')->group(function () {

    Route::post('product-images', [ProductController::class,'storeProductImage'])
        ->name('product-images.store');

    Route::get('/dashboard', [HomeController::class, 'index'])
        ->name('dashboard'); 

    // ✅ USERS (FIXED)
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');

    Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/delete/{id}', [UserController::class, 'delete'])->name('users.delete');

    // PAGES routes
   Route::get('/pages', [PageController::class, 'index'])->name('pages.index');
   Route::get('/pages/create', [PageController::class, 'create'])->name('pages.create');
   Route::post('/pages/store', [PageController::class, 'store'])->name('pages.store');

   Route::get('/pages/edit/{id}', [PageController::class, 'edit'])->name('pages.edit');
   Route::post('/pages/update/{id}', [PageController::class, 'update'])->name('pages.update');
   Route::delete('/pages/delete/{id}', [PageController::class, 'delete'])->name('pages.delete');


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

        Route::get('/shipping', [ShippingController::class, 'create'])->name('shipping.create');
        Route::post('/shipping', [ShippingController::class, 'store'])->name('shipping.store');
        Route::get('/shipping/delete/{id}', [ShippingController::class, 'delete'])->name('shipping.delete');
        Route::get('/shipping/edit/{id}', [ShippingController::class, 'edit'])->name('shipping.edit');
        Route::post('/shipping/update/{id}', [ShippingController::class, 'update'])->name('shipping.update');
        Route::post('/get-shipping-charge', [CartController::class, 'getShippingCharge'])->name('get.shipping');

        Route::get('/sub-categories', [SubcategoryController::class, 'index'])
            ->name('sub-categories.index');

        Route::get('/sub-categories/create', [SubcategoryController::class, 'create'])
            ->name('sub-categories.create');

        Route::post('/sub-categories', [SubcategoryController::class, 'store'])
            ->name('sub-categories.store');

        Route::get('/sub-categories/{subcategory}/edit', [SubcategoryController::class, 'edit'])
            ->name('sub-categories.edit');

        Route::put('/sub-categories/{subcategory}', [SubcategoryController::class, 'update'])
            ->name('sub-categories.update');

        Route::delete('/sub-categories/{subcategory}', [SubcategoryController::class, 'destroy'])
            ->name('sub-categories.destroy');

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

        Route::post('/temp-images', [TempImagesController::class, 'create'])
            ->name('temp-images.create');

        Route::get('/get-subcategories', [ProductSubCategoryController::class, 'index'])
            ->name('subcategories');

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
        | Orders Routes (ONLY ADDITION)
        |--------------------------------------------------------------------------
        */

        Route::get('/orders', [OrderController::class, 'index'])
            ->name('orders.index');

        Route::get('/orders/{id}', [OrderController::class, 'show'])
            ->name('orders.show');

        Route::get('/orders/{id}/status/{status}', [OrderController::class, 'updateStatus'])
            ->name('orders.status');

        Route::post('/logout', [AdminLoginController::class, 'logout'])
            ->name('logout');

    });

});

Route::get('/shop/{categorySlug?}/{subCategorySlug?}', 
    [ShopController::class,'index']
)->name('shop');

Route::get('/product/{slug}',[ShopController::class,'product'])->name('front.product');

Route::get('/cart',[CartController::class,'cart'])->name('front.cart');
Route::post('/add-to-cart',[CartController::class,'addToCart'])->name('front.addToCart');
Route::post('/cart/remove/{id}',[CartController::class,'removeCart'])->name('front.cart.remove');
Route::post('/cart/update/{id}',[CartController::class,'updateCart'])->name('front.cart.update');

Route::get('/login',[AuthController::class,'login'])->name('login');
Route::get('/register',[AuthController::class,'register'])->name('register');

Route::post('/register',[AuthController::class,'storeRegister'])->name('storeRegister');
Route::post('/login',[AuthController::class,'loginUser'])->name('loginUser');

Route::middleware(['auth'])->group(function () {

    Route::get('/profile',[AuthController::class,'profile'])->name('profile');
    Route::post('/profile/update',[AuthController::class,'updateProfile'])->name('profile.update');

    Route::get('/orders',[AuthController::class,'orders'])->name('orders');

    Route::post('/logout',[AuthController::class,'logout'])->name('logout');

    Route::get('/order/{id}', [AuthController::class, 'orderDetail'])
        ->name('order.detail')
        ->middleware('auth');

});

Route::get('/checkout',[CartController::class,'checkout'])->name('front.checkout');
Route::post('/place-order',[CartController::class,'placeOrder'])->name('place.order');
Route::post('/apply-coupon', [CartController::class, 'applyCoupon'])->name('apply.coupon');

Route::prefix('admin')->middleware('auth:admin')->group(function(){

    Route::get('/coupons', [DiscountCodeController::class, 'index'])
        ->name('admin.coupons.index');

    Route::get('/coupons/create', [DiscountCodeController::class, 'create'])
        ->name('admin.coupons.create');

    Route::post('/coupons/store', [DiscountCodeController::class, 'store'])
        ->name('admin.coupons.store');

    Route::get('/coupons/edit/{id}', [DiscountCodeController::class, 'edit'])
        ->name('admin.coupons.edit');

    Route::post('/coupons/update/{id}', [DiscountCodeController::class, 'update'])
        ->name('admin.coupons.update');

    Route::get('/coupons/delete/{id}', [DiscountCodeController::class, 'destroy'])
        ->name('admin.coupons.delete');

    //profile
     Route::get('/profile', [SettingsController::class, 'profile'])
    ->name('admin.profile');       
      
    //admin change password routes
    Route::get('/change-password', [SettingsController::class, 'changePassword'])
        ->name('admin.change.password');

    Route::post('/update-password', [SettingsController::class, 'updatePassword'])
        ->name('admin.update.password');
        
    //approve reviews and rating routes    
    Route::get('/reviews', [ReviewController::class, 'index'])->name('admin.reviews.index');
    Route::get('/reviews/approve/{id}', [ReviewController::class, 'approve'])->name('admin.reviews.approve');
    Route::get('/reviews/delete/{id}', [ReviewController::class, 'delete'])->name('admin.reviews.delete');        

});

Route::middleware('auth')->group(function () {

    Route::get('/wishlist', [App\Http\Controllers\WishlistController::class, 'index'])->name('wishlist.index');

    Route::post('/wishlist/add/{id}', [App\Http\Controllers\WishlistController::class, 'add'])->name('wishlist.add');

    Route::delete('/wishlist/remove/{id}', [App\Http\Controllers\WishlistController::class, 'remove'])->name('wishlist.remove');

     //Change password routes
    Route::get('/change-password', [AuthController::class, 'changePassword'])->name('password.change');
    Route::post('/update-password', [AuthController::class, 'updatePassword'])->name('password.update');   

});

//User forgot password routes
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForm'])
    ->name('forgot.password');

Route::post('/forgot-password', [ForgotPasswordController::class, 'sendOtp'])
    ->name('forgot.password.send');

Route::get('/reset-password', [ForgotPasswordController::class, 'showResetForm'])
    ->name('reset.password');

Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])
    ->name('reset.password.update');
 
//Review and rating routes
Route::post('/review/store', [ReviewController::class, 'store'])
    ->name('review.store');

