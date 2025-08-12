<?php

use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminOnly;
use Illuminate\Support\Facades\Route;

Route::get("/", [GeneralController::class, "index"])->name("index");

Route::prefix('/movie')->group(function () {
    Route::get('/popular', [MovieController::class, 'popular'])->name('movie.popular');
    Route::get('/search', [MovieController::class, 'search'])->name('movie.search');
    Route::get('/page/{movie}', [MovieController::class, 'show'])->name('movie.show');
    Route::middleware(['auth', AdminOnly::class])->group(function () {
        Route::get('/create', [MovieController::class, 'create'])->name('movie.create');
        Route::post('/store', [MovieController::class, 'store'])->name('movie.store');
        Route::post('/', [MovieController::class, 'store'])->name('movie.store');
        Route::get('/edit/{movie}', [MovieController::class, 'edit'])->name('movie.edit');
        Route::put('/update', [MovieController::class, 'update'])->name('movie.update');
        Route::get('/delete/{movie}', [MovieController::class, 'destroy'])->name('movie.delete');
    });
});
Route::prefix("/favorite")->group(function() {
    Route::get("/save/{movie_id}", [FavoriteController::class, "store"])->name("favorite.save");
});

Route::prefix("/user")->group(function() {
    Route::get('/{user}', [UserController::class, 'index'])->name('user.index');
    Route::get('/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/update', [UserController::class, 'update'])->name('user.update');
    Route::get('/delete/{user}', [UserController::class, 'destroy'])->name('user.delete');
});

Route::prefix("/auth")->group(function() {
    Route::post("/login", [UserController::class, "auth_login"])->name("auth.login");
    Route::post("/logon", [UserController::class, "auth_logon"])->name("auth.logon");
});

Route::get("/login", [UserController::class, "login"])->name("login");
Route::get("/logon", [UserController::class, "logon"])->name("logon");
Route::get("/logout", [UserController::class, "logout"])->name("logout");