<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $fillable = [
      'staff_id',
      'reason',
      'start_date',
      'end_date', 
      'status',
      'slip'
  ];

  public function staff() {
    return $this->belongsTo('App\Staff');
  }
}
