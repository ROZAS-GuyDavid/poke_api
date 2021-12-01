<?php

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

//Users
Route::prefix('/user')->group( function() {
    Route::post('/login', 'Api\v1\LoginController@login');
});

//Pokemon
Route::middleware('auth:api')->get('/pokemon/all', 'Api\v1\PokemonController@getAllPokemon');
Route::middleware('auth:api')->get('/pokemon/{id}', 'Api\v1\PokemonController@getPokemon');