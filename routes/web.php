<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PagesController::class, "index"])->name('index');

Route::get("/about", [PagesController::class, "about"]);
Route::get("/post", [PostController::class, "post"]);

//Route::resource('post', [PostController::class]);
//Route::resource('post', 'PostController');

Route::resource('post', PostController::class);

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index']);
