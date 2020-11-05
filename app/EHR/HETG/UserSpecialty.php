<?php

namespace App\EHR\HETG;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class UserSpecialty extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'specialty_id', 'principal'
    ];

    public function users() {
        // return $this->hasMany('App\User');
        return $this->belongsTo('App\User','user_id');
    }

    public function specialties() {
        return $this->hasMany('App\EHR\HETG\Specialty');
    }

    // public function specialty() {
    //     return $this->belongsTo('App\EHR\HETG\Specialty');
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
    protected $table = 'hm_user_specialties';
}
