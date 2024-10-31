<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:api']], function () {
  Route::get('/user', function (Request $request) {
    return $request->user();
});
  Route::post('/logout', [AuthController::class, 'logout']);
  Route::post('/products/create',[ProductController::class,'create']);
  Route::patch('/product/{product}',[ProductController::class,'update']);
Route::delete('/product/{product}',[ProductController::class,'destroy']);

});


Route::post('/register', [AuthController::class, 'register']);

Route::get('/product/allproduct',[ProductController::class,'index']);
Route::get('/product/single/{product}',[ProductController::class,'show']);





