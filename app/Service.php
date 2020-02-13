<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
      'type',
      'description',
      'time_taken',
      'branch_id',
      'price'
  ];

  public function branch() {
  	return $this->belongsTo('App\Branch');
  }
  
  public function staff() {
  	return $this->belongsToMany('App\Staff', 'staff_services', 'staff_id', 'service_id')->withTimestamps();
  }

}
