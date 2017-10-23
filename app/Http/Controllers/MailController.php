<?php

namespace App\Http\Controllers;

use App\Inquiry;
use App\Mail\InquiryRecieved;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
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
            'material' => 'required',
            'pages' => 'required',
            'printing' => 'required',
            'colors' => 'required',
            'edition' => 'required'
        ]);

        $data = $request->all();

        $inquiry = new Inquiry($request->all());

        Mail::to('spam@dailysh.it')
            ->send(new InquiryRecieved($inquiry));

        // dd(Mail::raw('test'));


        return response($inquiry, 200);
    }
}
