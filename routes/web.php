<?php

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('/register', 'AuthController@register');
$router->post('/login', 'AuthController@login');
$router->get('/logout', 'AuthController@logout');

$router->group(['prefix'=>'boards'], function($router){
  $router->get('/', 'BoardController@index');
  $router->get('/{id}', 'BoardController@show');
  $router->post('/', 'BoardController@store');
  $router->put('/{id}', 'BoardController@update');
  $router->delete('/{id}', 'BoardController@destroy');
});
