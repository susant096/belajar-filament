<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [MainController::class, 'home'])->name('home');
Route::get('/post/{slug}', [MainController::class, 'post'])->name('post');