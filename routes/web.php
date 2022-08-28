<?php

use App\Http\Controllers\ArticleController;

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/articles', 'ArticleController@index');
$router->get('/articles/{id}', 'ArticleController@show');
$router->post('/articles/store', 'ArticleController@store');
$router->put('/articles/update/{id}', 'ArticleController@update');
$router->delete('/articles/destroy/{id}', 'ArticleController@destroy');

$router->get('/categories', 'CategoryController@index');
$router->get('/categories/{id}', 'CategoryController@show');
$router->post('/categories/store', 'CategoryController@store');
$router->put('/categories/update/{id}', 'CategoryController@update');
$router->delete('/categories/destroy/{id}', 'CategoryController@destroy');

