<?php

namespace App\EHR\HETG;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Specialty extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'id', 'id_n820', 'id_sigte', 'specialty_name', 'color', 'user_id'
  ];

  public function medical_programmings() {
      return $this->hasMany('App\EHR\HETG\MedicalProgramming');
  }

  public function calendarProgrammings() {
      return $this->hasMany('App\EHR\HETG\CalendarProgramming');
  }

  public function userSpecialties() {
      return $this->hasMany('App\EHR\HETG\UserSpecialty');
  }

  public function user() {
      return $this->belongsTo('App\User');
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
  protected $table = 'hm_specialties';
}
