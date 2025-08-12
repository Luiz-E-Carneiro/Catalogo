<?php

use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminOnly;
use Illuminate\Support\Facades\Route;

// Acho melhor para redirecionamento rápido e já ir na função... 
// OU
// ----> é apenas "/" ser para movies (acho q resolve e é o 'certo' mas n testei ainda)
// Route::get('/', fn () => redirect()->route('movie.index')); 

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
        Route::delete('delete/{movie}', [MovieController::class, 'destroy'])->name('movie.destroy');
    });
});
Route::prefix("/favorite")->group(function() {
    Route::get("/save/{movie_id}", [FavoriteController::class, "store"])->name("favorite.save");
});

Route::middleware('owns.account')->group(function () {
    Route::get('/user/{user}', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/delete/{user}', [UserController::class, 'delete'])->name('user.delete');
});
Route::get('/user/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user/update', [UserController::class, 'update'])->name('user.update');

Route::prefix("/auth")->group(function() {
    Route::post("/login", [UserController::class, "auth_login"])->name("auth.login");
    Route::post("/logon", [UserController::class, "auth_logon"])->name("auth.logon");
});

Route::get("/login", [UserController::class, "login"])->name("login");
Route::get("/logon", [UserController::class, "logon"])->name("logon");
Route::get("/logout", [UserController::class, "logout"])->name("logout");