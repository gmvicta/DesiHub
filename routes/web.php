<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// controllers
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;

///// USER ROUTES /////

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('User/Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/products', function () {
    return Inertia::render('User/Products'); // Ensure this matches your component's path
})->middleware(['auth', 'verified'])->name('products');

Route::get('/cart', function () {
    return Inertia::render('User/Cart'); // This should match the name of your Cart.vue component
})->middleware(['auth', 'verified'])->name('cart');

Route::get('/purchases', function () {
    return Inertia::render('User/Purchases'); // Ensure this matches your component's path
})->middleware(['auth', 'verified'])->name('purchases');

Route::get('/checkout', function () {
    return Inertia::render('User/Checkout'); // This should match your Checkout.vue component
})->middleware(['auth', 'verified'])->name('checkout');

Route::get('/points/redemption', function () {
    return Inertia::render('User/Points_redemption'); // Ensure this matches your component's path
})->middleware(['auth', 'verified'])->name('points.redemption');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/loyalty-points', function () {
        return Inertia::render('User/Loyalty_points'); // Ensure this matches your component's path
    })->name('loyalty.points');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


///// END /////


// ADMIN ROUTES

Route::group(['prefix' => 'admin', 'middleware' => 'redirectAdmin'], function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('admin.login.post');
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');
});

//admin middleware
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    //products routes 
    Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');
    //  Route::post('/products/store',[ProductController::class,'store'])->name('admin.products.store');
    //  Route::put('/products/update/{id}',[ProductController::class,'update'])->name('admin.products.update');
    //  Route::delete('/products/image/{id}',[ProductController::class,'deleteImage'])->name('admin.products.image.delete');
    //  Route::delete('/products/destory/{id}',[ProductController::class,'destory'])->name('admin.products.destory');

});


// //user rotues
// 
// Route::get('/', [UserController::class,'index'])->name('home');
// Route::get('/dashboard',[DashboardController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');
// 
// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// 
//     //chekcout 
//     Route::prefix('checkout')->controller(CheckoutController::class)->group((function()  {
//         Route::post('order','store')->name('checkout.store');
//         Route::get('success','success')->name('checkout.success');
//         Route::get('cancel','cancel')->name('checkout.cancel');
//     }));
//   
// });
// 
// //add to cart 
// 
// Route::prefix('cart')->controller(CartController::class)->group(function () {
//     Route::get('view','view')->name('cart.view');
//     Route::post('store/{product}','store')->name('cart.store');
//     Route::patch('update/{product}','update')->name('cart.update');
//     Route::delete('delete/{product}','delete')->name('cart.delete');
// });
// 
// //routes for products list and filter 
// Route::prefix('products')->controller(ProductListController::class)->group(function ()  {
//     Route::get('/','index')->name('products.index');
//     
// });
// 
// 
// 
// //end
// 
// //admin routs
// 
// Route::group(['prefix' => 'admin', 'middleware' => 'redirectAdmin'], function () {
//     Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
//     Route::post('login', [AdminAuthController::class, 'login'])->name('admin.login.post');
//     Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');
// });
// 
// 
// //end
require __DIR__ . '/auth.php';
