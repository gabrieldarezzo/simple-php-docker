<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/



$router->get('/health', function () use ($router) {
    return 'ok';
});


$router->get('/', function () use ($router) {
    return 'Hello World';
});


$router->get('/dbtest', function () use ($router) {
    dd(DB::getPDO());
});



$router->get('/random', 'PokemonController@random');
$router->get('/call', 'PokemonController@call');
$router->get('/pdf', 'PokemonController@pdf');
