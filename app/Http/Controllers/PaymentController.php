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

        } catch(RequestException $e) {
            return response('Internal Server Error.', 500);
        } 

        $body = json_decode((string) $response->getBody());

        return response()->json($body, 200);
    }

    /**
     * Get Payment Status by Checkout Id
     * @param Request
     * @return Response
     */

    public function status (Request $request) {
        $this->validate($request, [
            'id' => 'required'
        ]);
        $input = $request->all();
        $payment = new Payment();
        $client = new Client();

        try {
            
            $uri = implode('/', [
                $payment->url(),
                $input['id'],
                'payment'
            ]);
            $response = $client->request('GET', $uri);

        } catch (RequestException $e) {
            return response('Internal Server Error.', 500);
        }

        $body = json_decode((string) $response->getBody());

        return response()->json($body, 200);
    }
}