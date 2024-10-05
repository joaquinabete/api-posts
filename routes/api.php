<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/posts', function() {
    return 'Listando todos los Posts';
});

Route::get('/posts/{id}', function() {
    return 'Obteniendo un solo Post';
});

Route::post('/posts', function() {
    return 'Creando un Post';
});
