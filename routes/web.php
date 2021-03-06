<?php

use App\Http\Controllers\HomePageController;
use App\Http\Controllers\AboutPageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UsesPageController;
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

Route::feeds();
Route::get('/', HomePageController::class)->name('home');
Route::get('/about', AboutPageController::class)->name('about');
Route::get('/uses', UsesPageController::class)->name('uses');
Route::get('/{post}', PostController::class)->name('post');
