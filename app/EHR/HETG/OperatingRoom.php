<?php

namespace App\EHR\HETG;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OperatingRoom extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'description', 'location', 'color', 'medic_box', 'user_id'
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
