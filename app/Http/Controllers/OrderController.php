<?php

namespace App\Http\Controllers;

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
            'phone' => 'required',
            'mail' => 'required|email',
            'title' => 'required',
            'format' => 'required',
            'orientation' => 'required',
            'product' => 'required',
            'material' => 'required',
            'pages' => 'required',
            'printing' => 'required',
            'colors' => 'required',
            'edition' => 'required',
        ]);

        $mail = [
            'inquiry' => new Inquiry($request->all()), 
            'date' => Carbon::now()->formatLocalized('%d.%m.%Y um %H:%M Uhr')
        ];

        Mail::send('mails.order.admin', $mail, function ($m) {
            $m->to(env('MAIL_TO'));
            $m->subject('Bestellung auf notizbücher-shop.com');
        });

        Mail::send('mails.order.confirmation', $mail, function ($m) use ($mail) {
            $m->to($mail['inquiry']['mail']);
            $m->subject('Bestellbestätigung auf notizbücher-shop.com');
        });

        return response($mail['inquiry'], 200);
    }
}
