<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checklist extends Model {

  protected $fillable = [
    'name',
    'street',
    'zip',
    'town',
    'phone',
    'mail',
    'title',
    'product',
    'format',
    'pages',
    'orientation',
    'printing',
    'colors',
    'material',
    'cover-material',
    'edition',
    'description',
    'date'
  ];

  protected $hidden = [

  ];
}