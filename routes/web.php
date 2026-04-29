<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'index']);
Route::resource('posts', PostController::class);
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');

