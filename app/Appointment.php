<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
      'time', 
      'date',
      'code',
      'staff_service_id',
      'branch_id',
      'user_id'
  ];

  public function branch() {
  	return $this->belongsTo('App\Branch');
  }

  public function user() {
  	return $this->belongsTo('App\User');
  }

  public function staff_service() {
  	return $this->belongsTo('App\StaffService');
  }

  public function payment() {
    return $this->hasOne('App\Payment');
  }

}
