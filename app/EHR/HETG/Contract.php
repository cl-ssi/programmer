<?php

namespace App\EHR\HETG;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Contract extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'rut', 'year', 'law', 'contract_id',  'weekly_hours', 'shift_system',
        'obs', 'legal_holidays', 'compensatory_rest', 'administrative_permit',
        'training_days', 'breastfeeding_time', 'weekly_collation',
        'contract_start_date', 'contract_end_date', 'unit', 'unit_code','service_id'
        //, 'user_id'
    ];

    public function rrhh() {
        return $this->belongsTo('App\EHR\HETG\Rrhh', 'rut');
    }

    public function unscheduled_programmings() {
        return $this->hasMany('App\EHR\HETG\UnscheduledProgramming');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function logs() {
        return $this->morphMany('App\EHR\HETG\Log','model')->where('diferences','<>',"[]");
    }

    public function service() {
        return $this->belongsTo('App\EHR\HETG\Service');
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
    protected $table = 'hm_contracts';
}
