<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    protected $fillable = [
      'code',
      'used'
  ];

  public function payment() {
  	return $this->hasOne('App\Payment');
  }
}


