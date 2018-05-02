<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
// use Carbon\Carbon;
use App\Order;
use App\Payment;
// use Auth;
use Log;

class PaymentController extends Controller
{
    public function __construct()
    {
    }

    /**
     * Prepare Payment Process and get authentication data from
     * Payment Object, which gets its Information from Environment
     * Variables.
     * 
     * @param Request
     * @return Response
     */

    public function prepare (Request $request) {
        $this->validate($request, [
            'amount' => 'required|numeric',
            'type' => 'required|size:2'
        ]);

        $payment = new Payment($request->all());

        try {
            $response = (new Client())->request('POST', $payment->url(), [
                'form_params' => $payment->prepareConnection()
            ]);
            $body = json_decode((string) $response->getBody());
            return response()->json($body, 200);
        } catch(RequestException $e) {
            return response('Internal Server Error.', 500);
        } 
    }

    /**
     * Get Payment Status by Checkout Id
     * @param Request
     * @return Response
     */

    public function status (Request $request) {
        $this->validate($request, [
            'checkout_id' => 'required'
        ]);
        $input = $request->all();
        $client = new Client();
        $order = Order::where('checkout_id', $input['checkout_id'])->get();

        try {
            $uri = implode('/', [
                env('VRPAY_HOST'),
                $input['checkout_id'],
                'payment'
            ]);
            $response = $client->request('GET', $uri);
            $body = json_decode((string) $response->getBody());

            if ($body->result->code == '000.100.110' || $body->result->code == '000.000.000') {
            	return response()->json($body);
	    }	
        } catch (RequestException $e) {
            return response('Internal Server Error.', 500);
        }
    }
}
