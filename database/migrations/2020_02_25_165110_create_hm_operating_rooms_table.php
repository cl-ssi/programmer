<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHmOperatingRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hm_operating_rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('location')->nullable();
            $table->string('color')->nullable();
            $table->boolean('medic_box')->default(0);
            //$table->unsignedBigInteger('user_id');

            //$table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('hm_user_operating_rooms', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedInteger('operating_room_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('operating_room_id')->references('id')->on('hm_operating_rooms')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('hm_calendar_programming', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('rut')->nullable();
            $table->unsignedInteger('specialty_id')->nullable();
            $table->unsignedInteger('profession_id')->nullable();
            $table->unsignedInteger('operating_room_id')->nullable();
            $table->datetime('start_date');
            $table->datetime('end_date');
            //$table->unsignedBigInteger('user_id');

            //$table->foreign('user_id')->references('id')->on('users');
            $table->foreign('rut')->references('rut')->on('hm_rrhh')->onDelete('cascade');
            $table->foreign('specialty_id')->references('id')->on('hm_specialties')->onDelete('cascade');
            $table->foreign('profession_id')->references('id')->on('hm_professions')->onDelete('cascade');
            $table->foreign('operating_room_id')->references('id')->on('hm_operating_rooms')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('hm_theoretical_programming', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->unsignedInteger('rut')->nullable();
            // $table->unsignedInteger('activity_id')->nullable();
            $table->unsignedInteger('contract_id')->nullable();
            $table->unsignedInteger('rut')->nullable();
            $table->unsignedInteger('specialty_id')->nullable();
            $table->unsignedInteger('profession_id')->nullable();
            $table->unsignedInteger('activity_id')->nullable();
            $table->string('start_date');
            $table->string('end_date');
            $table->decimal('performance', 8, 2)->nullable();
            $table->string('contract_day_type')->nullable();
            $table->integer('year')->nullable();
            //$table->unsignedBigInteger('user_id');

            //$table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('rut')->references('rut')->on('hm_rrhh')->onDelete('cascade');
            // $table->foreign('activity_id')->references('id')->on('hm_activities')->onDelete('cascade');
            $table->foreign('contract_id')->references('id')->on('hm_contracts')->onDelete('cascade');
            $table->foreign('rut')->references('rut')->on('hm_rrhh')->onDelete('cascade');
            $table->foreign('specialty_id')->references('id')->on('hm_specialties')->onDelete('cascade');
            $table->foreign('profession_id')->references('id')->on('hm_professions')->onDelete('cascade');
            $table->foreign('activity_id')->references('id')->on('hm_activities')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('hm_operating_room_programming', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedInteger('operating_room_id')->nullable();
            $table->unsignedInteger('specialty_id')->nullable();
            $table->unsignedInteger('profession_id')->nullable();

            $table->string('start_date');
            $table->string('end_date');
            $table->integer('year')->nullable();

            // $table->unsignedBigInteger('user_id');
            // $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('specialty_id')->references('id')->on('hm_specialties')->onDelete('cascade');
            $table->foreign('profession_id')->references('id')->on('hm_professions')->onDelete('cascade');
            $table->foreign('operating_room_id')->references('id')->on('hm_operating_rooms')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('hm_cutoff_dates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetime('date');
            $table->string('observation');
            // $table->unsignedBigInteger('user_id');
            // $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('hm_cutoff_dates');
        Schema::dropIfExists('hm_operating_room_programming');
        Schema::dropIfExists('hm_theoretical_programming');
        Schema::dropIfExists('hm_calendar_programming');
        Schema::dropIfExists('hm_user_operating_rooms');
        Schema::dropIfExists('hm_operating_rooms');
    }
}
