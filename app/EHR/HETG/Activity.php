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
      'id', 'id_activity', 'mother_activity_id', 'activity_type_id', 'activity_name', 'user_id'
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

  public function activityType() {
      return $this->belongsTo('App\EHR\HETG\ActivityType');
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
  protected $table = 'hm_activities';
}
