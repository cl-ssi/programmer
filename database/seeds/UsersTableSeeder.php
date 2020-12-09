<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Permission;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //los usuarios a continuación son solo para un ambiente de prueba.

        //usuarios del sistema
        $user = new User();
        $user->id = 1;
        $user->dv = "9";
        $user->name = "Administrador";
        $user->email = "nombre@redsalud.gob.cl";
        $user->password = bcrypt('clave');
        $user->save();
        $user->assignRole('usuario');
        $user->givePermissionTo(Permission::all());

		    //médicos
        $user = new User();$user->id = 44202611;$user->dv = '4';$user->name = 'LEIDY JOHANA MOLINA PRIETO';$user->password = bcrypt('clave');$user->save();$user->assignRole('profesional');$user->givePermissionTo('programacion teorica');$user->givePermissionTo('programacion medica');

        //no médicos
        $user = new User();$user->id = 5177420;$user->dv = '5';$user->name = 'ARMANDO  HENER NUÑEZ';$user->password = bcrypt('clave');$user->save();$user->assignRole('profesional');$user->givePermissionTo('programacion teorica');$user->givePermissionTo('programacion no medica');

    }
}
