<?php

use App\Http\Controllers\API\PostController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/create',[PostController::class,'create']);
Route::get('/get',[PostController::class,'get']);
Route::get('/posts/{id}',[PostController::class,'show']);
Route::patch('/edit/{id}',[PostController::class,'edit']);
Route::post('/update/{id}',[PostController::class,'update']);
Route::delete('/delete/{id}',[PostController::class,'delete']);

// Route::apiResource('posts', PostController::class);

