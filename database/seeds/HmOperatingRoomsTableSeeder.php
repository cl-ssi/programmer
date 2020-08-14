<?php

use Illuminate\Database\Seeder;
use App\EHR\HETG\OperatingRoom;

class HmOperatingRoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      OperatingRoom::Create(['id' => 1,'name'=>'PC1', 'description'=>'Pabellón Cirugia 1','location'=>'HETG','color'=>'AB2567']);
      OperatingRoom::Create(['id' => 2,'name'=>'PC2', 'description'=>'Pabellón Cirugia 2','location'=>'HETG','color'=>'AB1212']);
      OperatingRoom::Create(['id' => 3,'name'=>'PC3', 'description'=>'Pabellón Cirugia 3','location'=>'HETG','color'=>'0D1AAB']);
      OperatingRoom::Create(['id' => 4,'name'=>'PC4', 'description'=>'Pabellón Cirugia 4','location'=>'HETG','color'=>'6C97AB']);
      OperatingRoom::Create(['id' => 5,'name'=>'PC5', 'description'=>'Pabellón Cirugia 5','location'=>'HETG','color'=>'11AB0E']);
      OperatingRoom::Create(['id' => 6,'name'=>'PC6', 'description'=>'Pabellón Cirugia 6','location'=>'HETG','color'=>'AB586F']);
      OperatingRoom::Create(['id' => 7,'name'=>'PC7', 'description'=>'Pabellón Cirugia 7','location'=>'HETG','color'=>'A5AB37']);
      OperatingRoom::Create(['id' => 8,'name'=>'PC8', 'description'=>'Pabellón Cirugia 8','location'=>'HETG','color'=>'AB998F']);
    }
}
