<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDescriptionActivities extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      Schema::table('hm_activities', function (Blueprint $table) {
          $table->LONGTEXT('description')->after('activity_name')->nullable();
      });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
      Schema::table('hm_activities', function (Blueprint $table) {
          $table->LONGTEXT('description');
      });
  }
}
