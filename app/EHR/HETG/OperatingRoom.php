<?php

namespace App\EHR\HETG;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class OperatingRoom extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'description', 'location', 'color', 'medic_box'
        //, 'user_id'
    ];

    public function calendarProgrammings() {
        return $this->hasMany('App\EHR\HETG\CalendarProgramming');
    }

    public function userOperatingRooms() {
        return $this->belongsToMany('App\EHR\HETG\UserOperatingRoom');
    }

    public function user() {
        return $this->belongsToMany('App\User');
    }

    public function specialties()
    {
        return $this->belongsToMany('App\EHR\HETG\Specialty', 'hm_operating_room_specialties')
                    ->wherePivot('deleted_at', null);
                    // ->withPivot('performance');
    }

    public function professions()
    {
        return $this->belongsToMany('App\EHR\HETG\Profession', 'hm_operating_room_professions')
                    ->wherePivot('deleted_at', null);
                    // ->withPivot('performance');
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
    protected $table = 'hm_operating_rooms';
}
