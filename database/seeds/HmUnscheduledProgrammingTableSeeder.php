<?php

use Illuminate\Database\Seeder;
use App\EHR\HETG\UnscheduledProgramming;

class HmUnscheduledProgrammingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         UnscheduledProgramming::Create(['contract_id'=>714,'rut'=>16264972,'specialty_id'=>13,'activity_id'=>1,'assigned_hour'=>3,'hour_performance'=>3,'year'=>2020,'user_id'=>17430005, 'user_id'=>1]);
         UnscheduledProgramming::Create(['contract_id'=>714,'rut'=>16264972,'specialty_id'=>13,'activity_id'=>2,'assigned_hour'=>4,'hour_performance'=>3,'year'=>2020,'user_id'=>17430005, 'user_id'=>1]);
         UnscheduledProgramming::Create(['contract_id'=>714,'rut'=>16264972,'specialty_id'=>13,'activity_id'=>10,'assigned_hour'=>2,'hour_performance'=>3,'year'=>2020,'user_id'=>17430005, 'user_id'=>1]);
         UnscheduledProgramming::Create(['contract_id'=>714,'rut'=>16264972,'specialty_id'=>13,'activity_id'=>23,'assigned_hour'=>1,'hour_performance'=>NULL,'year'=>2020,'user_id'=>17430005, 'user_id'=>1]);
         UnscheduledProgramming::Create(['contract_id'=>714,'rut'=>16264972,'specialty_id'=>13,'activity_id'=>25,'assigned_hour'=>1,'hour_performance'=>NULL,'year'=>2020,'user_id'=>17430005, 'user_id'=>1]);
         UnscheduledProgramming::Create(['contract_id'=>714,'rut'=>16264972,'specialty_id'=>13,'activity_id'=>5,'assigned_hour'=>28,'hour_performance'=>NULL,'year'=>2020,'user_id'=>17430005, 'user_id'=>1]);
         UnscheduledProgramming::Create(['contract_id'=>714,'rut'=>16264972,'specialty_id'=>13,'activity_id'=>7,'assigned_hour'=>9,'hour_performance'=>0.25,'year'=>2020,'user_id'=>17430005, 'user_id'=>1]);
         UnscheduledProgramming::Create(['contract_id'=>714,'rut'=>16264972,'specialty_id'=>13,'activity_id'=>8,'assigned_hour'=>2,'hour_performance'=>2,'year'=>2020,'user_id'=>17430005, 'user_id'=>1]);

         UnscheduledProgramming::Create(['contract_id'=>2,'rut'=>16941966,'specialty_id'=>15,'activity_id'=>1,'assigned_hour'=>6,'hour_performance'=>3,'year'=>2020,'user_id'=>17430005, 'user_id'=>1]);
         UnscheduledProgramming::Create(['contract_id'=>2,'rut'=>16941966,'specialty_id'=>15,'activity_id'=>2,'assigned_hour'=>2,'hour_performance'=>3,'year'=>2020,'user_id'=>17430005, 'user_id'=>1]);
         UnscheduledProgramming::Create(['contract_id'=>2,'rut'=>16941966,'specialty_id'=>15,'activity_id'=>3,'assigned_hour'=>3,'hour_performance'=>NULL,'year'=>2020,'user_id'=>17430005, 'user_id'=>1]);
         UnscheduledProgramming::Create(['contract_id'=>2,'rut'=>16941966,'specialty_id'=>15,'activity_id'=>26,'assigned_hour'=>5,'hour_performance'=>NULL,'year'=>2020,'user_id'=>17430005, 'user_id'=>1]);
         UnscheduledProgramming::Create(['contract_id'=>2,'rut'=>16941966,'specialty_id'=>15,'activity_id'=>6,'assigned_hour'=>16,'hour_performance'=>0.5,'year'=>2020,'user_id'=>17430005, 'user_id'=>1]);

         UnscheduledProgramming::Create(['contract_id'=>688,'rut'=>17842068,'specialty_id'=>9,'activity_id'=>5,'assigned_hour'=>28,'hour_performance'=>NULL,'year'=>2020,'user_id'=>17430005, 'user_id'=>1]);
         UnscheduledProgramming::Create(['contract_id'=>689,'rut'=>17842068,'specialty_id'=>9,'activity_id'=>1,'assigned_hour'=>3,'hour_performance'=>3,'year'=>2020,'user_id'=>17430005, 'user_id'=>1]);
         UnscheduledProgramming::Create(['contract_id'=>689,'rut'=>17842068,'specialty_id'=>9,'activity_id'=>2,'assigned_hour'=>4,'hour_performance'=>3,'year'=>2020,'user_id'=>17430005, 'user_id'=>1]);
         UnscheduledProgramming::Create(['contract_id'=>689,'rut'=>17842068,'specialty_id'=>9,'activity_id'=>10,'assigned_hour'=>5,'hour_performance'=>3,'year'=>2020,'user_id'=>17430005, 'user_id'=>1]);
         UnscheduledProgramming::Create(['contract_id'=>689,'rut'=>17842068,'specialty_id'=>9,'activity_id'=>23,'assigned_hour'=>1,'hour_performance'=>NULL,'year'=>2020,'user_id'=>17430005, 'user_id'=>1]);
         UnscheduledProgramming::Create(['contract_id'=>689,'rut'=>17842068,'specialty_id'=>9,'activity_id'=>4,'assigned_hour'=>1,'hour_performance'=>NULL,'year'=>2020,'user_id'=>17430005, 'user_id'=>1]);
         UnscheduledProgramming::Create(['contract_id'=>689,'rut'=>17842068,'specialty_id'=>9,'activity_id'=>20,'assigned_hour'=>1,'hour_performance'=>2,'year'=>2020,'user_id'=>17430005, 'user_id'=>1]);
         UnscheduledProgramming::Create(['contract_id'=>689,'rut'=>17842068,'specialty_id'=>9,'activity_id'=>7,'assigned_hour'=>6,'hour_performance'=>0.25,'year'=>2020,'user_id'=>17430005, 'user_id'=>1]);
         UnscheduledProgramming::Create(['contract_id'=>689,'rut'=>17842068,'specialty_id'=>9,'activity_id'=>8,'assigned_hour'=>1,'hour_performance'=>2,'year'=>2020,'user_id'=>17430005, 'user_id'=>1]);

    }
}
