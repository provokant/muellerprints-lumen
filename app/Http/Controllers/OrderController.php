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
            'delivery'
        ]);

        // Log::info($request);

        $mail = [
            'order' => new Order($request->all()), 
            'date' => Carbon::now()->formatLocalized('%d.%m.%Y um %H:%M Uhr')
        ];

        Log::info($mail['order']['products']);

        // dd($mail['order']['products']);

        Mail::send('mails.order.admin', $mail, function ($m) {
            $m->to(env('MAIL_TO'));
            $m->subject('Neue Bestellung auf notizbücher-shop.com');
        });

        Mail::send('mails.order.confirmation', $mail, function ($m) use ($mail) {
            $m->to($mail['order']['email']);
            $m->subject('Bestellbestätigung auf notizbücher-shop.com');
        });

        return response($mail['order'], 200);
    }
}
