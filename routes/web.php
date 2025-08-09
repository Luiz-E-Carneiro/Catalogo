<?php

use App\Http\Controllers\GeneralController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Acho melhor para redirecionamento rápido e já ir na função...
// Route::get('/', fn () => redirect()->route('movie.index')); 

Route::get("/", [GeneralController::class, "index"])->name("index");

Route::prefix('movie')->group(function () {
    Route::get('/popular', [MovieController::class, 'popular'])->name('movie.popular');
    Route::get('/filtered', [MovieController::class, 'filtered'])->name('movie.filtered');
});


Route::resource('/movie', MovieController::class);


Route::resource('/user', UserController::class);
Route::prefix("/auth")->group(function() {
    Route::post("/login", [UserController::class, "auth_login"])->name("auth.login");
    Route::post("/logon", [UserController::class, "auth_logon"])->name("auth.logon");
});

Route::get("/logout", [UserController::class, "logout"])->name("logout");
Route::get("/login", [UserController::class, "login"])->name("login");
Route::get("/logon", [UserController::class, "logon"])->name("logon");