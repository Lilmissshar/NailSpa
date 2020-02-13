<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
      'name',
      'location'
  ];

  public function staff() {
  	return $this->hasMany('App\Staff');
  }

  public function service() {
  	return $this->hasMany('App\Service');
  }

  public function appointment() {
  	return $this->hasMany('App\Appointment');
  }

}
