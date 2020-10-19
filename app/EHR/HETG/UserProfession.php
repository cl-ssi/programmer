<?php

namespace App\EHR\HETG;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class UserProfession extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'profession_id'
    ];

    public function users()
    {
        return $this->hasMany('App\User');
    }

    // public function professions()
    // {
    //     return $this->hasMany('App\EHR\HETG\Profession');
    // }

    public function professions()
    {
        return $this->belongsTo('App\EHR\HETG\Profession');
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
    protected $table = 'hm_user_professions';
}
