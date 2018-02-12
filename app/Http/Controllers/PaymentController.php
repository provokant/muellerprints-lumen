<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Payment;
use Auth;
use Log;

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

        return response()->json($payment, 200);
    }
}