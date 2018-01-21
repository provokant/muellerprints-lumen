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

$router->get('/', function() use ($router) {
    return 'API powered by NEXTLEVELSHIT (www.dailysh.it) · mail@dailysh.it for questions';
});

$router->post('/', 'MailController@send');

$router->post('/mail', 'MailController@send');

$router->post('/order', 'OrderController@send');

$router->post('/register', 'RegisterController@create');
$router->post('/activate', 'RegisterController@activate');

$router->post('/forgot-pw', 'ForgotPasswordController@send');
$router->post('/forgot-pw', 'ForgotPasswordController@activate');

$router->post('/login', ['middleware' => 'auth', 'LoginController@index']);