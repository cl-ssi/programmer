<?php

namespace App\EHR\HETG;

use Illuminate\Database\Eloquent\Model;

class ProfessionActivity extends Model
{
    //

    protected $table = 'hm_profession_activity';


    protected $fillable = [
        'profession_id','activity_id','performance',
    ];


}
