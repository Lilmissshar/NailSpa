<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnavailableTimes extends Model
{
     protected $fillable = [
      'staff_id',
      'date',
      'time',
      'all_day',
      'reason'
  ];

  public function staff() {
  	return $this->belongsToMany('App\Staff');
  }
}
