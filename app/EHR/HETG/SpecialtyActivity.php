<?php

namespace App\EHR\HETG;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpecialtyActivity extends Model
{
    protected $fillable = [
        'specialty_id','activity_id','performance'
    ];

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

     protected $table = 'hm_specialty_activities';
}
