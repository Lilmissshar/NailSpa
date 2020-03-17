<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
      'service_staff_id',
      'customer_id',
      'duration',
      'status',
      'date',
      'time'
  ];

  public function service_staff() {
    return $this->belongsTo('App\ServiceStaff');
  }

  public function customer() {
    return $this->belongsTo('App\Customer');
  }

  public function review() {
    return $this->hasOne('App\Review');
  }

}
