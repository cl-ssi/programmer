<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
// use OwenIt\Auditing\Contracts\Auditable;

class User extends Authenticatable
{
    // use \OwenIt\Auditing\Auditable;
    use HasRoles;
    use Notifiable;

    /**
    * Ambos son por que cambié el id
    */
    protected $primaryKey = 'id';
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'dv', 'name', 'email', 'password'
    ];

    //relaciones
    public function userSpecialties() {
        return $this->hasMany('App\EHR\HETG\UserSpecialty');
        // return $this->belongsToMany('App\EHR\HETG\UserSpecialty', 'hm_user_specialties')
        //     ->wherePivot('deleted_at', null);
    }

    public function userProfessions() {
        return $this->hasMany('App\EHR\HETG\UserProfession');
    }

    public function userServices() {
        return $this->hasMany('App\EHR\HETG\UserService');
    }

    // public function specialties() {
    //     return $this->hasMany('App\EHR\HETG\Specialty');
    // }
    //
    // public function professions() {
    //     return $this->hasMany('App\EHR\HETG\Profession');
    // }

    public function specialties() {
        return $this->belongsToMany('App\EHR\HETG\Specialty', 'hm_user_specialties')
            ->wherePivot('deleted_at', null);
    }

    public function professions() {
        return $this->belongsToMany('App\EHR\HETG\Profession', 'hm_user_professions')
            ->wherePivot('deleted_at', null);
    }

    public function services() {
        return $this->belongsToMany('App\EHR\HETG\Service', 'hm_user_services')
            ->wherePivot('deleted_at', null);
    }

    public function userOperatingRooms() {
        return $this->hasMany('App\EHR\HETG\UserOperatingRoom');
    }

    public function unscheduledProgrammings() {
        return $this->hasMany('App\EHR\HETG\UnscheduledProgramming');
    }

    public function calendarProgrammings() {
        return $this->hasMany('App\EHR\HETG\CalendarProgramming');
    }

    public function operatingRoomProgrammings() {
        return $this->hasMany('App\EHR\HETG\OperatingRoomProgramming');
    }

    public function theoreticalProgrammings() {
        return $this->hasMany('App\EHR\HETG\TheoreticalProgramming');
    }



    //ingreso en mantenedores
    public function contracts() {
        return $this->hasMany('App\EHR\HETG\Contract');
    }

    public function activities() {
        return $this->hasMany('App\EHR\HETG\Activity');
    }

    public function motherActivities() {
        return $this->hasMany('App\EHR\HETG\MotherActivity');
    }

    public function rrhhs() {
        return $this->hasMany('App\EHR\HETG\Rrhh');
    }

    // public function specialties()
    // {
    //     return $this->belongsToMany('App\EHR\HETG\Activity', 'hm_specialty_activities')
    //         ->wherePivot('deleted_at', null)
    //         ->withPivot('performance');
    // }

    public function operatingRooms() {
        return $this->hasMany('App\EHR\HETG\OperatingRoom');
    }


    //funciones
    public function getSpecialtiesArray(){
        $array = array();
        foreach ($this->userSpecialties as $key => $userSpecialty) {
            $array[$key] = $userSpecialty->specialty_id;
        }
        return $array;
    }

    public function getProfessionsArray(){
        $array = array();
        foreach ($this->userProfessions as $key => $userProfession) {
            $array[$key] = $userProfession->profession_id;
        }
        return $array;
    }

    public function getOperatingRoomsArray(){
        $array = array();
        foreach ($this->userOperatingRooms as $key => $userOperatingRoom) {
            $array[$key] = $userOperatingRoom->operating_room_id;
        }
        return $array;
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
