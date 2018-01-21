<?php

namespace App\Http\Controllers;

use App\Inquiry;
use App\Mail\InquiryRecieved;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function __construct() 
    {
        //   
    }
    /**
     * Retrieve data, if user is successfully logged in
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        return response($request);
    }
}
