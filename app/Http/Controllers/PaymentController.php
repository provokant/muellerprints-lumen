<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
// use Carbon\Carbon;
// use App\User;
use App\Payment;
// use Auth;
// use Log;

class PaymentController extends Controller
{
    public function __construct()
    {
    }

    public function prepare (Request $request) {
        $this->validate($request, [
            'amount' => 'required|numeric',
            'type' => 'required|size:2'
        ]);

        $payment = new Payment($request->all());

        try {
            $response = (new Client())->request('POST', $payment->requestUrl(), [
                'form_params' => $payment->requestData()
            ]);
        } catch(RequestException $e) {
            return response('Internal Server Error.', 500);
        } 

        $body = json_decode((string) $response->getBody());

        return response()->json($body, 200);
    }
}