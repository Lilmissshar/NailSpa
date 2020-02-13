<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
      'method',
      'status',
      'appointment_id',
      'promo_code_id'
  ];

  public function promo_code() {
  	return $this->belongsTo('App\PromoCode');
  }

  public function appointment() {
  	return $this->belongsTo('App\Appointment');
  }

}
