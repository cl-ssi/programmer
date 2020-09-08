<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfessionActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hm_profession_activity', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('profession_id');
            $table->unsignedInteger('activity_id');
            $table->decimal('performance', 8, 2)->nullable();
            $table->timestamps();

            $table->foreign('profession_id')->references('id')->on('hm_professions');
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
        Schema::dropIfExists('hm_profession_activity');
    }
}
