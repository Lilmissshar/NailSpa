<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
      'staff_id',
      'customer_id',
      'duration',
      'status',
      'date',
      'time'
  ];

  public function staff() {
    return $this->belongsTo('App\Staff');
  }

  public function customer() {
    return $this->belongsTo('App\Customer');
  }

  public function reviews() {
    return $this->hasMany('App\Review');
  }

}
