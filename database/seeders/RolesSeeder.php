<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('roles')->delete();
      $superadmin = Role::create(['name' => 'super-admin', 'guard_name' => 'web']);
      $superadmin->givePermissionTo(Permission::all());
      $role1 = Role::create(['name' => 'company_admin', 'guard_name' => 'web']);
      $role2 = Role::create(['name' => 'company_manager', 'guard_name' => 'web']);
      $role3 = Role::create(['name' => 'company_worker', 'guard_name' => 'web']);
      $role4 = Role::create(['name' => 'user', 'guard_name' => 'web']);

    }
}
