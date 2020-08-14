<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHmRrhhTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hm_rrhh', function (Blueprint $table) {
            $table->integer('rut')->unsigned()->unique();
            $table->char('dv',1);
            $table->string('name');
            $table->string('fathers_family');
            $table->string('mothers_family')->nullable();
            $table->string('job_title');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('hm_contracts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('rut'); //fk
            $table->string('law')->nullable();
            $table->integer('contract_id')->nullable();
            $table->integer('weekly_hours')->nullable();
            $table->string('shift_system')->nullable();
            $table->string('obs')->nullable();
            $table->integer('legal_holidays')->nullable();
            $table->integer('compensatory_rest')->nullable();
            $table->integer('administrative_permit')->nullable();
            $table->integer('training_days')->nullable();
            $table->integer('breastfeeding_time')->nullable();
            $table->integer('weekly_collation')->nullable();
            $table->date('contract_start_date')->nullable();
            $table->date('contract_end_date')->nullable();
            $table->string('unit')->nullable();
            $table->string('unit_code')->nullable();
            $table->integer('year')->nullable();

            $table->foreign('rut')->references('rut')->on('hm_rrhh')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('hm_specialties', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('id_n820')->nullable();
            $table->bigInteger('id_sigte')->nullable();
            $table->string('specialty_name');
            $table->string('color')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('hm_mother_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('hm_activities', function (Blueprint $table) {
            $table->integer('id')->unsigned()->unique();
            $table->unsignedInteger('mother_activity_id')->nullable();
            $table->string('activity_name');

            $table->foreign('mother_activity_id')->references('id')->on('hm_mother_activities')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('hm_medical_programming', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('contract_id')->nullable();
            $table->unsignedInteger('rut')->nullable();
            $table->unsignedInteger('specialty_id')->nullable();
            $table->unsignedInteger('activity_id')->nullable();

            $table->decimal('assigned_hour', 8, 2)->nullable();
            $table->decimal('hour_performance', 8, 2)->nullable();
            $table->string('year')->nullable();
            $table->string('user_id');

            $table->foreign('contract_id')->references('id')->on('hm_contracts')->onDelete('cascade');
            $table->foreign('rut')->references('rut')->on('hm_rrhh')->onDelete('cascade');
            $table->foreign('specialty_id')->references('id')->on('hm_specialties')->onDelete('cascade');
            $table->foreign('activity_id')->references('id')->on('hm_activities')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hm_medical_programming');
        Schema::dropIfExists('hm_activities');
        Schema::dropIfExists('hm_mother_activities');
        Schema::dropIfExists('hm_specialties');
        Schema::dropIfExists('hm_contracts');
        Schema::dropIfExists('hm_rrhh');
    }
}
