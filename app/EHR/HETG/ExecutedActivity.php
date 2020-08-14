<?php

namespace App\EHR\HETG;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExecutedActivity extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'correlativo','programming_date', 'pabellon', 'origin_request', 'origin_request_desc', 'profesion', 'medico_rut',
        'medico_nombre', 'medico_especialidad', 'medico_especialidad_desc',
        'procedimiento_intervencion', 'procedimiento_intervencion_desc',
        'tiempo_est_interv', 'fecha_ingreso_tx', 'estado_intervencion',
        'estado_intervencion_desc', 'fecha_inicio_intervencion',
        'fecha_termino_intervencion', 'categoria_cirugia',
        'categoria_cirugia_desc', 'fecha_ingreso_pabellon',
        'fecha_ingreso_quirofano', 'fecha_salida_quirofano',
        'categoria_cirugia_tabla', 'categoria_cirugia_tabla_desc',
        'causa_suspension', 'causa_suspension_desc', 'speciality_id'
    ];

    public function rrhh() {
        return $this->belongsTo('App\EHR\HETG\Rrhh', 'medico_rut');
    }

    public function speciality() {
        return $this->belongsTo('App\EHR\HETG\Speciality');
    }

    public function getActivityDurationAttribute()
    {
        $duracion = $this->fecha_termino_intervencion->getTimestamp()
                    - $this->fecha_inicio_intervencion->getTimestamp();
        return $duracion;
    }

    public function getActivityDurationHumanAttribute()
    {
        $duracion = $this->fecha_termino_intervencion->getTimestamp()
                    - $this->fecha_inicio_intervencion->getTimestamp();
        return gmdate("H:i:s", $duracion);
    }


    use SoftDeletes;
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at','fecha_inicio_intervencion','fecha_termino_intervencion'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hm_executed_activities';
}
