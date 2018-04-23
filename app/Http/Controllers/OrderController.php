<?php

namespace App\Http\Controllers;

use Log;
use App\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function __construct() 
    {
        //   
    }
    /**
     * Send mail to administrator, if mail is sufficiantly filled.
     * Validate data and throw eventually an error.
     *
     * @param Request $request
     * @return Response
     */
    public function send(Request $request)
    {
        $this->validate($request, [
            'order_number' => 'required',
            'user_id' => '',
            'salutation' => 'required',
            'name' => 'required',
            'street' => 'required',
            'zip' => 'required',
            'town' => 'required',
            'country' => 'required',
            'email' => 'required',
            'company',
            'phone',
            'payment' => 'required',
            'terms' => 'required',
            'disclaimer' => 'required',
            'products' => 'required',
            'sum' => 'required',
            'delivery_salutation' => '',
            'delivery_name' => '',
            'delivery_street' => '',
            'delivery_zip' => '',
            'delivery_town' => '',
            'delivery_country' => '',
	        'shippingCost' => '',
	        'checkout_id' => '',
        ]);

        $order = Order::create($request->all());

        $mail = [
            'order' => $order, 
            'date' => Carbon::now()->formatLocalized('%d.%m.%Y um %H:%M Uhr')
        ];

        Mail::send('mails.order.admin', $mail, function ($m) {
            $m->to(env('MAIL_TO'));
            $m->subject('Neue Bestellung auf notizbücher-shop.com');
        });

        Mail::send('mails.order.confirmation', $mail, function ($m) use ($mail) {
            $m->to($mail['order']['email']);
            $m->subject('Bestellbestätigung auf notizbücher-shop.com');
        });

        return response()->json([
            'order_number' => $order->order_number,
            'order_status' => $order->order_status,
            'sum' => $order->sum
        ]);
    }

    public function checkoutInfo(Request $request)
    {
        $this->validate($request, [
            'checkout_id' => ''
        ]);
        $input = $request->all();

        try {
            $order = Order::where('checkout_id', $input['checkout_id'])->get()[0];

            return response()->json($order);

        } catch (Exception $e) {
            abort(404);
        }


    }
}
