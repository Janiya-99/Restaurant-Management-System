<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Super Admin']);

        $admin =  Role::create(['name' => 'Admin']);

        $user = Role::create(['name' => 'User']);

        $user->givePermissionTo([
            'user-prescription-create',
            'user-prescription-view',
            'user-quotation-view',
            'user-quotation-accept',
            'user-quotation-reject'
        ]);

        $admin->givePermissionTo([
            'admin-prescription-view',
            'admin-quotation-create',
            'admin-quotation-view'
        ]);
    }
}
