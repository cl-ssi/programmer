<?php

namespace App\EHR\HETG;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class ProfessionActivity extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'profession_id','activity_id','performance'
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

    protected $table = 'hm_profession_activities';
}
