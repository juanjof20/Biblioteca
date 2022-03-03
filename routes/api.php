<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('usuarios', 'UsuarioController');
Route::apiResource('libros', 'LibroController');
Route::apiResource('prestamos', 'PrestaController');
Route::apiResource('usuarios.libros','UsuarioLibroController');

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router)
{
    Route::post('register', 'JWTAuthController@register');
    Route::post('login', 'JWTAuthController@login')->name('login');
    Route::post('logout', 'JWTAuthController@logout')->name('logout');
    Route::post('refresh', 'JWTAuthController@refresh');
    Route::get('profile', 'JWTAuthController@profile');
});