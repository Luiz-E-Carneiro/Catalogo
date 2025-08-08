<?php

use App\Http\Controllers\GeneralController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get("/", [GeneralController::class, "index"])->name("index");
Route::resource('/movie', MovieController::class);
Route::resource('/user', UserController::class);
Route::get("/login", [UserController::class, "login"])->name("login");//adicionei só para poder acessar as páginas de login/logon
Route::get("/logon", [UserController::class, "logon"])->name("logon");