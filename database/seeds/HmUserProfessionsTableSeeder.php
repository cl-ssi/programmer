<?php

use Illuminate\Database\Seeder;
use App\EHR\HETG\UserProfession;

class HmUserProfessionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserProfession::Create(['user_id' => 1,'profession_id'=>1]);
        UserProfession::Create(['user_id' => 1,'profession_id'=>2]);
        UserProfession::Create(['user_id' => 1,'profession_id'=>3]);
        UserProfession::Create(['user_id' => 1,'profession_id'=>4]);
        UserProfession::Create(['user_id' => 1,'profession_id'=>5]);
        UserProfession::Create(['user_id' => 1,'profession_id'=>6]);
        UserProfession::Create(['user_id' => 1,'profession_id'=>7]);
        UserProfession::Create(['user_id' => 1,'profession_id'=>8]);
        UserProfession::Create(['user_id' => 1,'profession_id'=>9]);
        UserProfession::Create(['user_id' => 1,'profession_id'=>10]);
        UserProfession::Create(['user_id' => 1,'profession_id'=>11]);

        UserProfession::Create(['user_id' => 2,'profession_id'=>10]);
        UserProfession::Create(['user_id' => 2,'profession_id'=>11]);

        UserProfession::Create(['user_id' => 4,'profession_id'=>5]);
    }
}
