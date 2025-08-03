<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creating Super Admin User
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superAdmin@layoutindex.com',
            'password' => Hash::make('LayoutIndex@123')
        ]);
        $superAdmin->assignRole('Super Admin');

        $admin = User::create([
            'name' => 'Pharmacy Admin',
            'email' => 'pharmacy@gmail.com',
            'password' => Hash::make('123')
        ]);
        $admin->assignRole('Admin');
    }
}
