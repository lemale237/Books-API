<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\BookController;


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

$router->get('/books', 'BookController@index');
$router->get('/books/{id}', 'BookController@show');
$router->post('/books/create', 'BookController@store');
$router->put('/books/update/{id}', 'BookController@update');
$router->delete('/books/delete/{id}', 'BookController@destroy');



$router->get('/', function () use ($router) {
    return $router->app->version();
});
