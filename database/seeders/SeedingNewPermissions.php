<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Route;

class SeedingNewPermissions extends Seeder
{

    public function run()
    {
        $permissions = [
            ['name' => 'manage tenant', 'guard_name' => 'web'],
            ['name' => 'create tenant', 'guard_name' => 'web'],
            ['name' => 'edit tenant', 'guard_name' => 'web'],
            ['name' => 'delete tenant', 'guard_name' => 'web'],

            ['name' => 'manage lessor', 'guard_name' => 'web'],
            ['name' => 'create lessor', 'guard_name' => 'web'],
            ['name' => 'edit lessor', 'guard_name' => 'web'],
            ['name' => 'delete lessor', 'guard_name' => 'web'],
        ];
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission['name']], $permission);
        }

        $systemOwnerRole = Role::where('name', 'owner')->first();

        $systemOwnerPermission = [
            ['name' => 'manage tenant'],
            ['name' => 'create tenant'],
            ['name' => 'edit tenant'],
            ['name' => 'delete tenant'],
            ['name' => 'manage lessor'],
            ['name' => 'create lessor'],
            ['name' => 'edit lessor'],
            ['name' => 'delete lessor'],
        ];
        $systemOwnerRole->givePermissionTo($systemOwnerPermission);


    }
    
}
