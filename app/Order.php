<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

  protected $fillable = [
    'user_id',
    'order_number',
    'salutation',
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
    'delivery_salutation',
    'delivery_name',
    'delivery_street',
    'delivery_zip',
    'delivery_town',
    'delivery_country',
    'shippingCost'
  ];

  protected $hidden = [

  ];

  /**
   * Get corresponding User for the selected Order.
   * 
   * @return App\User
   */

  public function user() {
    return $this->belongsTo('App\User');
  }
}
