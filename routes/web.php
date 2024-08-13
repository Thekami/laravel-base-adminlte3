<?php

use App\Http\Controllers\Panel\HomeController;
use App\Http\Controllers\Panel\LoginController;
use App\Http\Controllers\Panel\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/home', [HomeController::class, 'index'])->name('home.index');

Route::get('/registro', [RegisterController::class, 'show'])->name('registro');
Route::post('/registrarse', [RegisterController::class, 'registrarse'])->name('registrarse');

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('loguearse');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
