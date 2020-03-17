<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Staff extends Authenticatable {
  protected $table = "staffs";

  use Notifiable;

  protected $guard = 'staffs';

  protected $fillable = [
    'name',
    'description',
    'age',
    'email',
    'mobile',
    'password'
  ];  

  protected $hidden = [
    'password', 'remember_token',
  ];

  public function services() {
  	return $this->belongsToMany('App\Service', 'service_staffs', 'staff_id', 'service_id')->withTimestamps();
  }

  public function leaves() {
    return $this->hasMany('App\Leave');
  }
}
