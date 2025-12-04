<?php

use App\Http\Controllers\Articles;
use App\Http\Controllers\Concerts;
use App\Http\Controllers\Contact;
use App\Http\Controllers\Explore;
use App\Http\Controllers\Feeds;
use App\Http\Controllers\Home;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/contact', Contact::class)->name('contact');
Route::get('/explore', Explore::class)->name('explore');

Route::get('/feeds', Feeds\Index::class)->name('feeds.index');

Route::get('articles', Articles\Index::class)->name('articles.index');
Route::get('articles/{article}', Articles\Show::class)->name('articles.show');
Route::get('posts/{article}', Articles\Show::class)->name('posts.show');

Route::get('concerts', Concerts\Index::class)->name('concerts.index');
Route::get('concerts/{date}/{concert}', Concerts\Show::class)->name('concerts.show');
