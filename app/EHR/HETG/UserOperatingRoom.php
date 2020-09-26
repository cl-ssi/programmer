<?php

namespace App\EHR\HETG;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserOperatingRoom extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'operating_room_id'
    ];

    public function users() {
        return $this->belongsTo('App\User');
    }

    public function operating_rooms() {
        return $this->belongsTo('App\EHR\HETG\OperatingRoom');
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
    protected $table = 'hm_user_operating_rooms';
}
