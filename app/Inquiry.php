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
    'printing',
    'colors',
    'edition',
    'date'
  ];

  protected $hidden = [

  ];
}