<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOperatingRoomSpecProfTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('hm_operating_room_specialties', function (Blueprint $table) {
          $table->unsignedInteger('operating_room_id');
          $table->unsignedInteger('specialty_id');
          $table->foreign('operating_room_id')->references('id')->on('hm_operating_rooms')->onDelete('cascade');
          $table->foreign('specialty_id')->references('id')->on('hm_specialties');

          $table->timestamps();
          $table->softDeletes();
      });

      Schema::create('hm_operating_room_professions', function (Blueprint $table) {
          $table->unsignedInteger('operating_room_id');
          $table->unsignedInteger('profession_id');
          $table->foreign('operating_room_id')->references('id')->on('hm_operating_rooms')->onDelete('cascade');
          $table->foreign('profession_id')->references('id')->on('hm_professions');

          $table->timestamps();
          $table->softDeletes();
      });

      Schema::table('hm_activities', function (Blueprint $table) {
          $table->boolean('programmable')->default(0)->after('performance');
      });

      Schema::create('hm_services', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('service_name');
          $table->string('color')->nullable();

          $table->timestamps();
          $table->softDeletes();
      });

      Schema::create('hm_user_services', function (Blueprint $table) {
          $table->unsignedBigInteger('service_id');
          $table->unsignedBigInteger('user_id');
          $table->boolean('principal')->default(0);
          
          $table->foreign('service_id')->references('id')->on('hm_services');
          $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('hm_operating_room_specialties');
        Schema::dropIfExists('hm_operating_room_professions');
        Schema::table('hm_activities', function (Blueprint $table) {
            $table->dropColumn('programmable');
        });
        Schema::dropIfExists('hm_user_services');
        Schema::dropIfExists('hm_services');
    }
}
