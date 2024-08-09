<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/home', [HomeController::class, 'index'])->name('home.index');

Route::get('/registro', [RegisterController::class, 'show'])->name('registro');
Route::post('/registrarse', [RegisterController::class, 'registrarse'])->name('registrarse');

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/loguearse', [LoginController::class, 'loguearse'])->name('loguearse');
