<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return inertia::render('Inicio');
});
Route::get('/registro', function () {
    return inertia::render('Registro');
});
