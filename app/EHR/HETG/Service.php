<?php

namespace App\EHR\HETG;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Service extends Model implements Auditable
{
  use \OwenIt\Auditing\Auditable;
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'id', 'service_code', 'service_name', 'color'
  ];

  public function users() {
      return $this->belongsToMany('App\EHR\HETG\User', 'hm_user_services')
          ->wherePivot('deleted_at', null);
  }

  public function contracts() {
      return $this->hasMany('App\EHR\HETG\Contract');
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
  protected $table = 'hm_services';
}
