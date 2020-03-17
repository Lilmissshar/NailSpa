<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable {
	use Notifiable;

	protected $guard = 'customer';

    protected $fillable = [
        'name',
        'email',
        'mobile', 
        'password',
        'is_active'
    ];

    protected $hidden = [
    	'password', 'remember_token',
    ];

  public function appointments() {
  	return $this->hasMany('App\Appointment');
  }
}
