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
        Permission::create(['name' => 'programacion teorica']);
        Permission::create(['name' => 'programacion medica']);
        Permission::create(['name' => 'programacion no medica']);
        Permission::create(['name' => 'programador pabellon']);
        Permission::create(['name' => 'programador']);
        Permission::create(['name' => 'reportes']);
        Permission::create(['name' => 'mantenedores']);
    }
}
