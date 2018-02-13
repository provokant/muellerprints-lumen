<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model {

  protected $fillable = [
    'amount',
    'type'
  ];

  protected $hidden = [];

  public function prepareConnection() {
    return [
      'amount' => $this->amount,
      'paymentType' => $this->type,
      'currency' => env('VRPAY_CURRENCY'),
      'authentication.userId' => env('VRPAY_USER'),
      'authentication.password' => env('VRPAY_PASSWORD'),
      'authentication.entityId' => env('VRPAY_KEY')
    ];
  }

  public function statusConnection() {
    return [
      'authentication.userId' => env('VRPAY_USER'),
      'authentication.password' => env('VRPAY_PASSWORD'),
      'authentication.entityId' => env('VRPAY_KEY')
    ];
  }

  public function url() {
    return (env('APP_ENV') === 'production' ? env('VRPAY_HOST') : env('VRPAY_TEST'));
  }
}