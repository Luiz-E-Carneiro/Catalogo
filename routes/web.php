<?php

use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Acho melhor para redirecionamento rápido e já ir na função... 
// OU
// ----> é apenas "/" ser para movies (acho q resolve e é o 'certo' mas n testei ainda)
// Route::get('/', fn () => redirect()->route('movie.index')); 

Route::get("/", [GeneralController::class, "index"])->name("index");

Route::prefix('/movie')->group(function () {
    Route::get('/filtered', [MovieController::class, 'filtered'])->name('movie.filtered');
    Route::get('/popular', [MovieController::class, 'popular'])->name('movie.popular');
    Route::get('/search', [MovieController::class, 'search'])->name('movie.search');

    Route::get('/', [MovieController::class, 'index'])->name('movie.index');
    Route::get('/{movie}', [MovieController::class, 'show'])->name('movie.show');
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/create', [MovieController::class, 'create'])->name('movie.create');
        Route::post('/', [MovieController::class, 'store'])->name('movie.store');
        Route::get('/{movie}/edit', [MovieController::class, 'edit'])->name('movie.edit');
        Route::put('/{movie}', [MovieController::class, 'update'])->name('movie.update');
        Route::delete('/{movie}', [MovieController::class, 'destroy'])->name('movie.destroy');
    });
});


Route::middleware('owns.account')->group(function () {
    Route::get('/user/{user}', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{user}/update', [UserController::class, 'update'])->name('user.update');
});

Route::prefix("/auth")->group(function() {
    Route::post("/login", [UserController::class, "auth_login"])->name("auth.login");
    Route::post("/logon", [UserController::class, "auth_logon"])->name("auth.logon");
});

Route::get("/login", [UserController::class, "login"])->name("login");
Route::get("/logon", [UserController::class, "logon"])->name("logon");
Route::get("/logout", [UserController::class, "logout"])->name("logout");