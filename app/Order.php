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
    'delivery',
    'shippingCost'
  ];

  protected $hidden = [

  ];

  /**
   * Get corresponding User for the selected Order.
   * 
   * @return App\User
   */

  public function orders() {
    return $this->belongsTo('App\User');
  }
}
