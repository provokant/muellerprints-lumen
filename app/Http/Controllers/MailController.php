<?php

namespace App\Http\Controllers;

use App\Inquiry;
use App\Checklist;
use App\Mail\InquiryRecieved;
use Carbon\Carbon;
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
    public function sendInquiry(Request $request)
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

        Mail::send('mails.inquiry.admin', $mail, function ($m) {
            $m->to(env('MAIL_TO'));
            $m->subject('Anfrage von muellerprints.de');
        });

        Mail::send('mails.inquiry.confirmation', $mail, function ($m) use ($mail) {
            $m->to($mail['inquiry']['mail']);
            $m->subject('Bestätigung Ihrer Anfrage auf muellerprints.de');
        });

        return response($mail['inquiry'], 200);
    }

     /**
     * Send mail to administrator, if mail is sufficiantly filled.
     * Validate data and throw eventually an error.
     *
     * @param Request $request
     * @return Response
     */
    public function sendChecklist(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'street' => 'required',
            'zip' => 'required',
            'town' => 'required',
            'mail' => 'required|email',
            'phone' => 'required',
            'pages' => 'required',
            'title' => 'required',
            'product' => 'required',
            'format' => 'required',
            'pages' => 'required',
            'orientation' => 'required',
            'printing' => 'required',
            'colors' => 'required',
            'material' => 'required',
            'cover-material' => 'required',
            'edition' => 'required',
            'description' => 'required',
            'date' => 'required',
        ]);

        $mail = [
            'checklist' => new Checklist($request->all()), 
            'date' => Carbon::now()->formatLocalized('%d.%m.%Y um %H:%M Uhr')
        ];

        Mail::send('mails.checklist.admin', $mail, function ($m) {
            $m->to(env('MAIL_TO'));
            $m->subject('Bestellung auf muellerprints.de');
        });

        Mail::send('mails.checklist.confirmation', $mail, function ($m) use ($mail) {
            $m->to($mail['checklist']['mail']);
            $m->subject('Bestätigung Ihrer Bestellung auf muellerprints.de');
        });

        return response($mail['checklist'], 200);
    }
}
