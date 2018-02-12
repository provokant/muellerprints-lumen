<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model {

  protected $fillable = [
    'amount',
    'type',
  ];

  protected $hidden = [

  ];

  static function connection() {
    return [
      'user' => env('VRPAY_USER'),
      'password' => env('VRPAY_PASSWORD'),
      'key' => env('VRPAY_KEY'),
      'host' => env('VRPAY_HOST')
    ];
  }
}