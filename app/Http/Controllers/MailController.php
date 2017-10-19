<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

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
            'oriantation' => 'required',
            'material' => 'required',
            'pages' => 'required',
            'printing' => 'required',
            'colors' => 'required',
            'edition' => 'required'
        ]);

        $data = $request->all();
        
        setlocale(LC_ALL, config('app.locale'));
        $data['date'] = Carbon::now()->formatLocalized('%A, %d.%m.%Y um %H:%M Uhr');

        

        return response($data, 200);
    }
}
