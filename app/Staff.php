<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable = [
      'name',
      'age',
      'email',
      'phone',
      'description',
      'branch_id',
      'commission'
  ];

  public function branch() {
  	return $this->belongsTo('App\Branch');
  }

  public function service() {
  	return $this->belongsToMany('App\Service', 'staff_services', 'staff_id', 'service_id')->withTimestamps();
  }

  public function unavailable_times() {
    return $this->belongsToMany('App\UnavailableTimes');
  }
}
