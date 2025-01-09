<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('registro',[AuthController::class, 'registro']);
Route::post('registro',[AuthController::class, 'registroPost']);

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'loginPost']);
Route::get('logout',[AuthController::class, 'logout']);

Route::get('inicio', [FrontController::class, 'inicio'])->middleware('auth');