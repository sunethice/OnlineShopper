<?php


use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
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
    // Route::get('/users','UserController@index');
    // Route::get('users/{user}','UserController@show');
    // Route::patch('users/{user}','UserController@update');
    // Route::get('users/{user}/orders','UserController@showOrders');
    // Route::patch('products/{product}/units/add','ProductController@updateUnits');
    // Route::patch('orders/{order}/deliver','OrderController@deliverOrder');
    // Route::resource('/orders', 'OrderController');
    // Route::resource('/products', 'ProductController')->except(['index','show']);
});

