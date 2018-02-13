<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model {

  protected $fillable = [
    'amount',
    'type'
  ];

  protected $hidden = [
    'checkoutId'
  ];

  public function requestData() {
    return [
      'amount' => $this->amount,
      'paymentType' => $this->type,
      'currency' => env('VRPAY_CURRENCY'),
      'authentication.userId' => env('VRPAY_USER'),
      'authentication.password' => env('VRPAY_PASSWORD'),
      'authentication.entityId' => env('VRPAY_KEY')
    ];
  }

  public function requestUrl() {
    return (env('APP_ENV') === 'production' ? env('VRPAY_HOST') : env('VRPAY_TEST'));
  }
}