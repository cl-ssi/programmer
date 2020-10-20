<?php

namespace App\EHR\HETG;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Profession extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'id_profession', 'profession_name', 'color'
        //, 'user_id'
    ];

    public function unscheduled_programmings() {
        return $this->hasMany('App\EHR\HETG\UnscheduledProgramming');
    }

    public function calendarProgrammings() {
        return $this->hasMany('App\EHR\HETG\CalendarProgramming');
    }

    public function userProfessions() {
        return $this->hasMany('App\EHR\HETG\UserProfession');
    }

    public function users() {
        return $this->belongsToMany('App\EHR\HETG\User', 'hm_user_professions')
            ->wherePivot('deleted_at', null);
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function activities()
    {
        return $this->belongsToMany('App\EHR\HETG\Activity','hm_profession_activities')
                    ->wherePivot('deleted_at', null)
                    ->withPivot('performance');
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
    protected $table = 'hm_professions';
}
