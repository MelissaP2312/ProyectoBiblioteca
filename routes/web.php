<?php

use Illuminate\Support\Facades\Route;

// Página principal
Route::get('/', function () {
    return view('main'); // Asegúrate de tener un archivo main.blade.php en resources/views
});

// Otras rutas
Route::get('/about', function () {
    return view('about'); // Asegúrate de tener un archivo about.blade.php
});

Route::get('/contact', function () {
    return view('contact'); // Asegúrate de tener un archivo contact.blade.php
});
