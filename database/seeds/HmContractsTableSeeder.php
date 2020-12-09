<?php

use Illuminate\Database\Seeder;
use App\EHR\HETG\Contract;

class HmContractsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contract::Create(['rut'=>44202611,'law'=>'LEY 19.664','contract_id'=>751677,'weekly_hours'=>22,'shift_system'=>'N','obs'=>NULL,'legal_holidays'=>20,'compensatory_rest'=>NULL,'administrative_permit'=>12,'training_days'=>10,'breastfeeding_time'=>NULL,'weekly_collation'=>180,'contract_start_date'=>'2019-01-01','contract_end_date'=>'2019-12-31','unit'=>'CR. MEDICINA','unit_code'=>NULL,'year'=>2020]);
    }
}
