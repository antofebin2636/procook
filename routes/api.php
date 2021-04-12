<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



//Show all products

Route::get('/products',[ProductController::class, 'index']);

//Show products of a given category
Route::get('category/{catname}',[ProductController::class, 'showByCat']);

//Show single products

Route::get('/product/{id}',[ProductController::class, 'show']);


//Add new product
Route::post('/product',[ProductController::class, 'store']);


//update a product
Route::put('/product/{id}',[ProductController::class, 'update']);


