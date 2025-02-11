<?php

use App\Http\Controllers\Admin\ArticlesController;
use App\Http\Controllers\Admin\ConcertsController;
use App\Http\Controllers\Admin\ShowAdminDashboard;
use App\Http\Controllers\Auth\AttemptLogin;
use App\Http\Controllers\Auth\ShowLoginForm;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', ShowLoginForm::class);
    Route::post('/login', AttemptLogin::class);

    Route::get('', ShowAdminDashboard::class);

    Route::get('/articles', [ArticlesController::class, 'index'])->name('admin.articles');
    Route::post('/articles', [ArticlesController::class, 'store']);
    Route::get('/articles/{article}', [ArticlesController::class, 'show'])->name('admin.articles.update');
    Route::put('/articles/{article}', [ArticlesController::class, 'update']);


    Route::get('/concerts', [ConcertsController::class, 'index'])->name('admin.concerts');
    Route::post('/concerts', [ConcertsController::class, 'store']);
    Route::get('/concerts/{concert}', [ConcertsController::class, 'show'])->name('admin.concerts.update');
    Route::put('/concerts/{concert}', [ConcertsController::class, 'update']);
});
