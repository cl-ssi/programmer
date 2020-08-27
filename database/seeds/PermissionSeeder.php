<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'administrador']);
        Permission::create(['name' => 'programador teorico']);
        Permission::create(['name' => 'programador pabellon']);
        Permission::create(['name' => 'programador calendario']);
        Permission::create(['name' => 'reportes']);
        Permission::create(['name' => 'mantenedores']);
    }
}
