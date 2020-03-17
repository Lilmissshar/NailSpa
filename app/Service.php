<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
      'name',
      'description',
      'duration',
      'price'
  ];
  
  public function staffs() {
  	return $this->belongsToMany('App\Staff', 'service_staffs', 'service_id', 'staff_id')->withTimestamps();
  }

}
