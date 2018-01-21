<?php

namespace App\Http\Controllers;

use App\Inquiry;
use App\Mail\InquiryRecieved;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function __construct() 
    {
        //   
    }
    /**
     * Register new user account and send activation mail
     *
     * @param Request $request
     * @return Response
     */
    public function send(Request $request)
    {
        return response($request);
    }
    /**
     * Register new user account and send activation mail
     *
     * @param Request $request
     * @return Response
     */
    public function activate(Request $request)
    {
        return response($request);
    }
}
