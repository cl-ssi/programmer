<?php

namespace App\EHR\HETG;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CalendarProgramming extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'id', 'rut', 'specialty_id', 'operating_room_id', 'start_date', 'end_date', 'user_id'
  ];

  public function operatingRoom() {
      return $this->belongsTo('App\EHR\HETG\OperatingRoom');
  }

  // public function medicalProgramming() {
  //     return $this->belongsTo('App\EHR\HETG\MedicalProgramming');
  // }

  public function rrhh() {
      return $this->belongsTo('App\EHR\HETG\Rrhh','rut');
  }

  public function specialty() {
      return $this->belongsTo('App\EHR\HETG\Specialty');
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
  protected $table = 'hm_calendar_programming';
}
