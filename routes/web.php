<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('movie.index'));

Route::resource('/movie', MovieController::class);

Route::resource('/user', UserController::class);

Route::get("/login", [UserController::class, "login"])->name("login");
Route::get("/logon", [UserController::class, "logon"])->name("logon");