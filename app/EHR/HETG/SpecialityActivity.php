<?php

namespace App\EHR\HETG;

use Illuminate\Database\Eloquent\Model;

class SpecialityActivity extends Model
{
    //

    protected $table = 'hm_speciality_activities';

    protected $fillable = [
        'speciality_id','activity_id','performance',
    ];


}
