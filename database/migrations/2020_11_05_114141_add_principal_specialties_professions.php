<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPrincipalSpecialtiesProfessions extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      Schema::table('hm_user_specialties', function (Blueprint $table) {
          $table->boolean('principal')->default(0)->after('specialty_id');
      });

      Schema::table('hm_user_professions', function (Blueprint $table) {
          $table->boolean('principal')->default(0)->after('profession_id');
      });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
      Schema::table('hm_user_specialties', function (Blueprint $table) {
          $table->dropColumn('principal');
      });

      Schema::table('hm_user_professions', function (Blueprint $table) {
          $table->dropColumn('principal');
      });
  }
}
