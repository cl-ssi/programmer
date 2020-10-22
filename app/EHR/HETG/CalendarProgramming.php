<?php

namespace App\EHR\HETG;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class CalendarProgramming extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'rut', 'specialty_id', 'profession_id', 'activity_id', 'operating_room_id', 'start_date', 'end_date'
        //, 'user_id'
    ];

    public function operatingRoom()
    {
        return $this->belongsTo('App\EHR\HETG\OperatingRoom');
    }

    // public function unscheduledProgramming() {
    //     return $this->belongsTo('App\EHR\HETG\UnscheduledProgramming');
    // }

    public function rrhh()
    {
        return $this->belongsTo('App\EHR\HETG\Rrhh', 'rut');
    }

    public function specialty()
    {
        return $this->belongsTo('App\EHR\HETG\Specialty');
    }

    public function profession()
    {
        return $this->belongsTo('App\EHR\HETG\Profession');
    }

    public function activity()
    {
        return $this->belongsTo('App\EHR\HETG\Activity');
    }

    public function user()
    {
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
    protected $table = 'hm_calendar_programming';
}
