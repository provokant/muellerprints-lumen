<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

  protected $fillable = [
    'name',
    'street',
    'zip',
    'town',
    'country',
    'email',
    'company',
    'phone',
    'payment',
    'terms',
    'disclaimer',
    'products',
    'sum',
    'delivery'
  ];

  protected $hidden = [

  ];
}