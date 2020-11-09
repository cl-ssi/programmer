<?php

namespace App\EHR\HETG;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class OperatingRoomProfession extends Model implements Auditable
{
  use \OwenIt\Auditing\Auditable;
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'operating_room_id', 'profession_id'
  ];

  // public function operating_rooms()
  // {
  //     return $this->hasMany('App\EHR\HETG\OperatingRoom');
  // }

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
  protected $table = 'hm_operating_room_professions';
}
