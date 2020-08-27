<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHmExecutedActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // Schema::create('hm_specialties', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->bigInteger('id_sigte');
        //     $table->bigInteger('id_n820');
        //     $table->string('specialty_name');
        //
        //     $table->timestamps();
        //     $table->softDeletes();
        // });

        // Schema::create('hm_executed_activities', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->bigInteger('correlativo');
        //     $table->datetime('programming_date')->nullable(); //nuevo campo 16/03/2020
        //     $table->string('pabellon')->nullable();
        //     $table->integer('origin_request'); //nuevo campo 16/03/2020
        //     $table->string('origin_request_desc'); //nuevo campo 16/03/2020
        //     $table->string('profesion');
        //     $table->string('medico_rut')->nullable();
        //     $table->string('medico_dv')->nullable();
        //     $table->string('medico_nombre');
        //     $table->UnsignedbigInteger('speciality_id'); //nuevo campo 16/03/2020
        //     $table->integer('medico_especialidad');
        //     $table->string('medico_especialidad_desc')->nullable();
        //     //$table->unsignedBigInteger('medico_especialidad'); //fk
        //     $table->integer('procedimiento_intervencion');
        //     $table->string('procedimiento_intervencion_desc')->nullable();
        //     $table->integer('tiempo_est_interv');
        //     $table->datetime('fecha_ingreso_tx')->nullable();
        //     $table->integer('estado_intervencion');
        //     $table->string('estado_intervencion_desc')->nullable();
        //     $table->datetime('fecha_inicio_intervencion')->nullable();
        //     $table->datetime('fecha_termino_intervencion')->nullable();
        //     $table->integer('categoria_cirugia')->nullable();
        //     $table->string('categoria_cirugia_desc')->nullable();
        //     $table->datetime('fecha_ingreso_pabellon')->nullable();
        //     $table->datetime('fecha_ingreso_quirofano')->nullable();
        //     $table->datetime('fecha_salida_quirofano')->nullable();
        //     $table->integer('categoria_cirugia_tabla')->nullable();
        //     $table->string('categoria_cirugia_tabla_desc')->nullable();
        //     $table->integer('causa_suspension')->nullable();
        //     $table->string('causa_suspension_desc')->nullable();
        //     $table->integer('anho')->nullable();
        //
        //     //$table->foreign('medico_especialidad')->references('id')->on('hm_specialties')->onDelete('cascade');
        //
        //     $table->timestamps();
        //     $table->softDeletes();
        // });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('hm_executed_activities');
        // Schema::dropIfExists('hm_specialties');
    }
}
