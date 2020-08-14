<?php

namespace App\EHR\HETG;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'id', 'mother_activity_id', 'activity_name'
  ];

  public function medical_programmings() {
      return $this->hasMany('App\EHR\HETG\OperatngRooms\MedicalProgramming');
  }

  public function theoretialProgrammings() {
      return $this->hasMany('App\EHR\HETG\TheoreticalProgramming');
  }

  public function motherActivity() {
      return $this->belongsTo('App\EHR\HETG\MotherActivity');
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
  protected $table = 'hm_activities';
}
