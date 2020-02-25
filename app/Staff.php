<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model {
  protected $table = 'staffs';

  protected $fillable = [
    'name',
    'description',
    'age',
    'email',
    'mobile'
  ];  

  // public function tableCall() {
  //   return
  // }

  public function services() {
  	return $this->belongsToMany('App\Service', 'service_staffs', 'staff_id', 'service_id')->withTimestamps();
  }

  public function leaves() {
    return $this->hasMany('App\Leave');
  }
}
