<?php

namespace App\EHR\HETG;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TheoreticalProgramming extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'id', 'rut', 'activity_id', 'week_day', 'start_time', 'end_time', 'year', 'user_id'
  ];

  // protected $casts = [
  //     'start_time' => 'date:hh:mm',
  //     'end_time' => 'date:hh:mm'
  // ];

  public function rrhh() {
      return $this->belongsTo('App\EHR\HETG\Rrhh','rut');
  }

  public function specialty() {
      return $this->belongsTo('App\EHR\HETG\Specialty');
  }

  public function activity() {
      return $this->belongsTo('App\EHR\HETG\Activity');
  }

  use SoftDeletes;
  /**
   * The attributes that should be mutated to dates.
   *
   * @var array
   */
  protected $dates = ['deleted_at'];

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'hm_theoretical_programming';
}
