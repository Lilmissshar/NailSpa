<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffService extends Model
{
    protected $fillable = [
      'staff_id',
      'service_id'
  ];

  public function staff() {
  	return $this->belongsTo('App\Staff');
  }

  public function service() {
  	return $this->belongsTo('App\Service');
  }
}
