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
            $table->integer('id_deis')->nullable();
            $table->integer('cod_estab_sirh')->nullable();
            $table->integer('rut')->unsigned()->unique();
            $table->char('dv',1);
            $table->boolean('risk_group')->default(0);
            $table->boolean('missing_condition')->default(0);
            $table->string('missing_reason')->nullable();
            $table->string('name');
            $table->string('fathers_family');
            $table->string('mothers_family')->nullable();
            $table->string('job_title');
            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')->references('id')->on('users');
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
            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('rut')->references('rut')->on('hm_rrhh')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('hm_specialties', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('id_specialty')->nullable();
            // $table->bigInteger('id_sigte')->nullable();
            $table->string('specialty_name');
            $table->string('color')->nullable();
            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('hm_user_specialties', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedInteger('specialty_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('specialty_id')->references('id')->on('hm_specialties');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('hm_professions', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('id_profession')->nullable();
            // $table->bigInteger('id_sigte')->nullable();
            $table->string('profession_name');
            $table->string('color')->nullable();
            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('hm_user_professions', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedInteger('profession_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('profession_id')->references('id')->on('hm_professions')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('hm_mother_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('hm_activity_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            //$table->unsignedBigInteger('user_id');

            //$table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('hm_activities', function (Blueprint $table) {
            // $table->integer('id')->unsigned()->unique();
            $table->increments('id');
            $table->bigInteger('id_activity')->nullable();
            $table->unsignedInteger('mother_activity_id')->nullable();
            $table->unsignedInteger('activity_type_id')->nullable();
            $table->string('activity_name');
            $table->boolean('performance')->default(0);
            //$table->unsignedBigInteger('user_id');

            //$table->foreign('user_id')->references('id')->on('users');
            $table->foreign('mother_activity_id')->references('id')->on('hm_mother_activities')->onDelete('cascade');
            $table->foreign('activity_type_id')->references('id')->on('hm_activity_types')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('hm_profession_activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('profession_id');
            $table->unsignedInteger('activity_id');
            $table->decimal('performance', 8, 2)->nullable();

            $table->foreign('profession_id')->references('id')->on('hm_professions');
            $table->foreign('activity_id')->references('id')->on('hm_activities');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('hm_specialty_activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('specialty_id');
            $table->unsignedInteger('activity_id');
            $table->decimal('performance', 8, 2)->nullable();

            $table->foreign('specialty_id')->references('id')->on('hm_specialties');
            $table->foreign('activity_id')->references('id')->on('hm_activities');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('hm_medical_programming', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('contract_id')->nullable();
            $table->unsignedInteger('rut')->nullable();
            $table->unsignedInteger('specialty_id')->nullable();
            $table->unsignedInteger('profession_id')->nullable();
            $table->unsignedInteger('activity_id')->nullable();

            $table->decimal('assigned_hour', 8, 2)->nullable();
            $table->decimal('hour_performance', 8, 2)->nullable();
            $table->string('year')->nullable();
            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('contract_id')->references('id')->on('hm_contracts')->onDelete('cascade');
            $table->foreign('rut')->references('rut')->on('hm_rrhh')->onDelete('cascade');
            $table->foreign('specialty_id')->references('id')->on('hm_specialties')->onDelete('cascade');
            $table->foreign('profession_id')->references('id')->on('hm_professions')->onDelete('cascade');
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
        Schema::dropIfExists('hm_user_professions');
        Schema::dropIfExists('hm_user_specialties');
        Schema::dropIfExists('hm_medical_programming');
        Schema::dropIfExists('hm_profession_activities');
        Schema::dropIfExists('hm_specialty_activities');
        Schema::dropIfExists('hm_activities');
        Schema::dropIfExists('hm_activity_types');
        Schema::dropIfExists('hm_mother_activities');
        Schema::dropIfExists('hm_professions');
        Schema::dropIfExists('hm_specialties');
        Schema::dropIfExists('hm_contracts');
        Schema::dropIfExists('hm_rrhh');
    }
}
