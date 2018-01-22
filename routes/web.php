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

$router->get('users', function() {    
    $users = [];
    foreach(App\User::all() as $user) {
        $user->orders = $user->orders;
        array_push($users, $user);
    }
    return response($users);
});

$router->get('orders', function() {
    $orders = [];
    foreach(App\Order::all() as $order) {
        $order->user = $order->user()->first();
        array_push($orders, $order);
    }
    return response($orders);
});
