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

$router->get('user/activate/{code}', 'UserController@activate');
$router->post('user/login', 'UserController@login');
$router->post('user/register', 'UserController@register');
$router->post('user/info', [
    'middleware' => 'authToken',
    'uses' => 'UserController@info'
]);

/*
 |--------------------------------------------------------------------------
 | Development section
 |--------------------------------------------------------------------------
 |
 | These routes should only be available in development mode. Sensible data
 | is provided and must be hidden in production mode.
 | To change these settings, go to .env and set APP_ENV=production|local
 |
 */
if (env('APP_ENV') === 'local') {
    $router->get('users', function() {    
        return response(App\User::all()->load('orders'));
    });
    
    $router->get('orders', function() {
        return response(App\Order::all()->load('user'));
    });
}


