<?php

use Illuminate\Support\Facades\Route;

Route::get('/health', fn() => response('ok', 200));

Route::get('/', function () {
    // Si tienes la vista por defecto de Laravel:
    return view('welcome');
    // O temporalmente:
    // return 'MoniFly online';
});
