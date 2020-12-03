<?php


use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShoppingCartsController;
use App\Models\ShoppingCarts;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('login', [AuthController::class, 'cpSignIn']);
Route::post('register', [AuthController::class, 'cpSignUp']);
Route::get('products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);


Route::group(['middleware' => 'auth:api'], function(){
    Route::post('logout', [AuthController::class, 'cpSignOut']);
    Route::get('getCart', [ShoppingCartsController::class, 'cpGetCart']);
    Route::post('updateCart', [ShoppingCartsController::class, 'cpUpdateCart']);
    Route::post('createCart', [ShoppingCartsController::class, 'cpCreateCart']);
    // Route::resource('/orders', 'OrderController');
    // Route::resource('/products', 'ProductController')->except(['index','show']);
});

