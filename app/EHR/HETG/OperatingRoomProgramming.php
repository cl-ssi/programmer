<?php

namespace App\EHR\HETG;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class OperatingRoomProgramming extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'operating_room_id', 'specialty_id', 'profession_id', 'start_date', 'end_date', 'year', 'user_id'
    ];

    public function specialty() {
        return $this->belongsTo('App\EHR\HETG\Specialty');
    }

    public function operatingRoom() {
        return $this->belongsTo('App\EHR\HETG\OperatingRoom');
    }

    public function user() {
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
    protected $table = 'hm_operating_room_programming';
}
