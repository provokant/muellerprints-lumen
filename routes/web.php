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


use Illuminate\Http\Request;
use App\Order;

$router->get('/', function() use ($router) {
    return 'API powered by NEXTLEVELSHIT (www.dailysh.it) · mail@dailysh.it for questions';
});

$router->post('/', 'MailController@sendInquiry');
$router->post('/mail', 'MailController@sendInquiry');

$router->post('/checklist', 'MailController@sendChecklist');

$router->post('/order', 'OrderController@send');
$router->post('/order/checkout-info', 'OrderController@checkoutInfo');

$router->get('user/activate/{code}', 'UserController@activate');
$router->post('user/login', 'UserController@login');
$router->post('user/register', 'UserController@register');
$router->post('user/send-reset-token', 'UserController@sendResetToken');
$router->post('user/reset-password', 'UserController@resetPassword');
$router->post('user/auth', [
    'middleware' => 'authToken',
    'uses' => 'UserController@auth'
]);
$router->post('user/orders', [
    'middleware' => 'authToken',
    'uses' => 'UserController@orders'
]);
$router->post('user/info', [
    'middleware' => 'authToken',
    'uses' => 'UserController@info'
]);
$router->post('user/update/email', [
    'middleware' => 'authToken',
    'uses' => 'UserController@updateEmail'
]);
$router->post('user/update/password', [
    'middleware' => 'authToken',
    'uses' => 'UserController@updatePassword'
]);
$router->post('user/update/info', [
    'middleware' => 'authToken',
    'uses' => 'UserController@updateInfo'
]);
$router->post('user/order/{id}/delete', [
    'middleware' => 'authToken',
    'uses' => 'UserController@deleteOrder'
]);

$router->post('payment/prepare', 'PaymentController@prepare');
$router->post('payment/status', 'PaymentController@status');

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
if (env('APP_ENV') != 'production') {
    $router->get('users', function() {    
        return response(App\User::all()->load('orders'));
    });
    
    $router->get('orders', function() {
        return response(App\Order::all()->load('user'));
    });

    $router->get('orders/{id:[0-9]+}', function($id) {
        return response(App\Order::findOrFail($id)->load('user'));
    });

    $router->get('user/{user:[0-9]+}/order/{order:[0-9]+}', function($user, $order) {
        return response(App\User::findOrFail($user)->orders->where('id', $order)->first());
    });

    $router->get('user/{user:[0-9]+}/order/{order:[0-9]+}/delete', function($user, $order) {
        $orderId = App\User::findOrFail($user)->orders->where('id', $order)->first()->id;

        $order = App\Order::findOrFail($orderId)->first();

        try {
            $order->forceDelete();
            return response('Bestellung wurde erfolgreich gelöscht.', 200);
        } catch (Exception $e) {
            return response('Die ausgewählte Bestellung konnte nicht gefunden werden.', 404);
        }
    });
}


