<?php

namespace App\EHR\HETG;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class ExecutedActivity extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'correlative', 'programming_date', 'operating_room', 'origin_request', 'origin_request_desc', 'profession', 'medic_rut','medic_dv',
        'medic_name', 'medic_specialty', 'medic_specialty_desc',
        'intervention_procedure', 'intervention_procedure_desc',
        'plane','plane_desc','extremity','extremity_desc',
        'estimated_intervention_time', 'fecha_ingreso_tx', 'estado_intervencion',
        'tx_entrance_date',
        'intervention_status','intervention_status_desc','intervention_start_date','intervention_end_date',
        'surgery_category','surgery_category_desc',
        'operating_room_entrance_date',
        'surgery_room_entrance_date', 'surgery_room_exit_date',
        'table_surgery_category', 'table_surgery_category_desc',
        'suspencion_cause', 'suspencion_cause_desc'
    ];

    public function rrhh()
    {
        return $this->belongsTo('App\EHR\HETG\Rrhh', 'medico_rut');
    }

    public function speciality()
    {
        return $this->belongsTo('App\EHR\HETG\Speciality');
    }

    public function getActivityDurationAttribute()
    {
        $duracion = $this->intervention_end_date->getTimestamp() - $this->intervention_start_date->getTimestamp();
        return $duracion;
    }

    public function getActivityDurationHumanAttribute()
    {
        $duracion = $this->intervention_end_date->getTimestamp()
            - $this->intervention_start_date->getTimestamp();
            // dd("x",$duracion);
        return gmdate("H:i:s", $duracion);
    }


    use SoftDeletes;
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'intervention_start_date', 'intervention_end_date'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hm_executed_activities';
}
