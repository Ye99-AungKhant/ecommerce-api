<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // Post::create([
    //     'name' =>'IPhone 12',
    //     'price' =>'1700000',
    //     'description'=>'Bosssss',
    //     'image'=>''
    // ]);
    return view('welcome');
});
