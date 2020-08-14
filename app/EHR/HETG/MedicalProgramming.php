<?php

namespace App\EHR\HETG;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicalProgramming extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'contract_id', 'rut', 'specialty_id', 'activity_id', 'assigned_hour', 'hour_performance', 'year', 'user_id'
    ];

    public function rrhh() {
        return $this->belongsTo('App\EHR\HETG\Rrhh', 'rut');
    }

    public function contract() {
        return $this->belongsTo('App\EHR\HETG\Contract');
    }

    public function activity() {
        return $this->belongsTo('App\EHR\HETG\Activity');
    }

    public function specialty() {
        return $this->belongsTo('App\EHR\HETG\Specialty');
    }

    // public function calendarProgrammings() {
    //     return $this->hasMany('App\EHR\HETG\CalendarProgramming');
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
    protected $table = 'hm_medical_programming';
}
