<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
      'appointment_id',
      'description'
  ];

  public function appointment() {
  	return $this->belongsTo('App\Appointment');
  }
}
