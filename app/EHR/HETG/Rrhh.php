<?php

namespace App\EHR\HETG;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Rrhh extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_deis', 'cod_estab_sirh', 'rut', 'dv', 'risk_group', 'missing_condition', 'missing_reason', 'name', 'fathers_family', 'mothers_family', 'job_title'
        //, 'user_id'
    ];

    public function executedActivities() {
        return $this->hasMany('App\EHR\HETG\ExecutedActivity', 'medic_rut');
    }

    public function contracts() {
        return $this->hasMany('App\EHR\HETG\Contract', 'rut');
    }

    // public function programming() {
    //     return $this->hasMany('App\EHR\HETG\OperatingRooms\UnscheduledProgramming', 'rut');
    // }
    public function unscheduled_programmings() {
        return $this->hasMany('App\EHR\HETG\UnscheduledProgramming', 'rut');
    }

    public function calendarProgrammings() {
        return $this->hasMany('App\EHR\HETG\CalendarProgramming', 'rut');
    }

    public function theoretialProgrammings() {
        return $this->hasMany('App\EHR\HETG\TheoreticalProgramming', 'rut');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function getFullNameAttribute()
    {
        return "{$this->name} {$this->fathers_family} {$this->mothers_family}";
    }

    public function getShortNameAttribute()
    {
        $arr = explode(" ",$this->name);
        return $arr[0]. " " . "{$this->fathers_family}";
    }

    protected $primaryKey = 'rut';

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
    protected $table = 'hm_rrhh';
}
