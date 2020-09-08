<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialityActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hm_speciality_activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('speciality_id');
            $table->unsignedInteger('activity_id');
            $table->decimal('performance', 8, 2)->nullable();
            $table->timestamps();

            $table->foreign('speciality_id')->references('id')->on('hm_specialties');
            $table->foreign('activity_id')->references('id')->on('hm_activities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('speciality_activities');
    }
}
