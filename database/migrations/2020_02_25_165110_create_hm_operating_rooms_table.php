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
            //$table->unsignedInteger('establishment_id');
            $table->string('location')->nullable();
            $table->string('color')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('hm_calendar_programming', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('rut')->nullable();
            $table->unsignedInteger('specialty_id')->nullable();
            $table->unsignedInteger('operating_room_id')->nullable();
            //$table->unsignedBigInteger('medical_programming_id')->nullable();
            $table->datetime('start_date');
            $table->datetime('end_date');
            // $table->enum('tipo',['legal_holidays', 'compensatory_rest', 'administrative_permit', 'training_days'])->nullable();
            $table->string('contract_day_type');

            $table->string('user_id');

            $table->foreign('rut')->references('rut')->on('hm_rrhh')->onDelete('cascade');
            $table->foreign('specialty_id')->references('id')->on('hm_specialties')->onDelete('cascade');
            $table->foreign('operating_room_id')->references('id')->on('hm_operating_rooms')->onDelete('cascade');
            //$table->foreign('medical_programming_id')->references('id')->on('hm_medical_programming')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('hm_theoretical_programming', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('rut')->nullable();
            $table->unsignedInteger('activity_id')->nullable();
            //$table->unsignedBigInteger('medical_programming_id')->nullable();
            $table->string('start_date');
            $table->string('end_date');
            $table->integer('year')->nullable();
            $table->string('user_id');

            $table->foreign('rut')->references('rut')->on('hm_rrhh')->onDelete('cascade');
            $table->foreign('activity_id')->references('id')->on('hm_activities')->onDelete('cascade');
            //$table->foreign('medical_programming_id')->references('id')->on('hm_medical_programming')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('hm_weekly_programming', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('activity_id')->nullable();
            $table->string('start_date');
            $table->string('end_date');
            $table->integer('year')->nullable();
            $table->string('user_id');

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
        Schema::dropIfExists('hm_weekly_programming');
        Schema::dropIfExists('hm_theoretical_programming');
        Schema::dropIfExists('hm_calendar_programming');
        Schema::dropIfExists('hm_operating_rooms');
    }
}
