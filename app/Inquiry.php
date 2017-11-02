<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model {

  protected $fillable = [
    'name',
    'phone',
    'mail',
    'title',
    'format',
    'orientation',
    'material',
    'pages',
    'product',
    'printing',
    'colors',
    'edition',
    'date',
    'description'
  ];

  protected $hidden = [

  ];
}