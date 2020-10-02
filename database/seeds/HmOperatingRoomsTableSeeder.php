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
      OperatingRoom::Create(['name'=>'PC1', 'description'=>'Pabellón Cirugia 1','location'=>'HETG','color'=>'AB2567','medic_box' => 0]);
      OperatingRoom::Create(['name'=>'PC2', 'description'=>'Pabellón Cirugia 2','location'=>'HETG','color'=>'AB1212','medic_box' => 0]);
      OperatingRoom::Create(['name'=>'PC3', 'description'=>'Pabellón Cirugia 3','location'=>'HETG','color'=>'0D1AAB','medic_box' => 0]);
      OperatingRoom::Create(['name'=>'PC4', 'description'=>'Pabellón Cirugia 4','location'=>'HETG','color'=>'6C97AB','medic_box' => 0]);
      OperatingRoom::Create(['name'=>'PC5', 'description'=>'Pabellón Cirugia 5','location'=>'HETG','color'=>'11AB0E','medic_box' => 0]);
      OperatingRoom::Create(['name'=>'PC6', 'description'=>'Pabellón Cirugia 6','location'=>'HETG','color'=>'AB586F','medic_box' => 0]);
      OperatingRoom::Create(['name'=>'PC7', 'description'=>'Pabellón Cirugia 7','location'=>'HETG','color'=>'A5AB37','medic_box' => 0]);
      OperatingRoom::Create(['name'=>'PC8', 'description'=>'Pabellón Cirugia 8','location'=>'HETG','color'=>'AB998F','medic_box' => 0]);

      OperatingRoom::Create(['name'=>'Box1', 'description'=>'Box1','location'=>'HETG','color'=>'AB998F','medic_box' => 1]);
      OperatingRoom::Create(['name'=>'Box2', 'description'=>'Box2','location'=>'HETG','color'=>'AB998F','medic_box' => 1]);
      OperatingRoom::Create(['name'=>'Box3', 'description'=>'Box3','location'=>'HETG','color'=>'AB998F','medic_box' => 1]);
      OperatingRoom::Create(['name'=>'Box4', 'description'=>'Box4','location'=>'HETG','color'=>'AB998F','medic_box' => 1]);
      OperatingRoom::Create(['name'=>'Box5', 'description'=>'Box5','location'=>'HETG','color'=>'AB998F','medic_box' => 1]);
      OperatingRoom::Create(['name'=>'Box6', 'description'=>'Box6','location'=>'HETG','color'=>'AB998F','medic_box' => 1]);
      OperatingRoom::Create(['name'=>'Box7', 'description'=>'Box7','location'=>'HETG','color'=>'AB998F','medic_box' => 1]);
      OperatingRoom::Create(['name'=>'Box8', 'description'=>'Box8','location'=>'HETG','color'=>'AB998F','medic_box' => 1]);
      OperatingRoom::Create(['name'=>'Box9', 'description'=>'Box9','location'=>'HETG','color'=>'AB998F','medic_box' => 1]);
      OperatingRoom::Create(['name'=>'Box10', 'description'=>'Box10','location'=>'HETG','color'=>'AB998F','medic_box' => 1]);
      OperatingRoom::Create(['name'=>'Box11', 'description'=>'Box11','location'=>'HETG','color'=>'AB998F','medic_box' => 1]);
      OperatingRoom::Create(['name'=>'Box12', 'description'=>'Box12','location'=>'HETG','color'=>'AB998F','medic_box' => 1]);
      OperatingRoom::Create(['name'=>'Box13', 'description'=>'Box13','location'=>'HETG','color'=>'AB998F','medic_box' => 1]);
      OperatingRoom::Create(['name'=>'Box14', 'description'=>'Box14','location'=>'HETG','color'=>'AB998F','medic_box' => 1]);
      OperatingRoom::Create(['name'=>'Box15', 'description'=>'Box15','location'=>'HETG','color'=>'AB998F','medic_box' => 1]);
      OperatingRoom::Create(['name'=>'Box16', 'description'=>'Box16','location'=>'HETG','color'=>'AB998F','medic_box' => 1]);
      OperatingRoom::Create(['name'=>'Box17', 'description'=>'Box17','location'=>'HETG','color'=>'AB998F','medic_box' => 1]);
      OperatingRoom::Create(['name'=>'Box18', 'description'=>'Box18','location'=>'HETG','color'=>'AB998F','medic_box' => 1]);
      OperatingRoom::Create(['name'=>'Box19', 'description'=>'Box19','location'=>'HETG','color'=>'AB998F','medic_box' => 1]);
      OperatingRoom::Create(['name'=>'Box20', 'description'=>'Box20','location'=>'HETG','color'=>'AB998F','medic_box' => 1]);
    }
}
