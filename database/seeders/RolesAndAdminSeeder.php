<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesAndAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['Admin', 'OperationsManager', 'Supervisor', 'Clerk', 'SafetyOfficer', 'Viewer'];
        foreach ($roles as $role) Role::firstOrCreate(['name' => $role]);

        $admin = User::firstOrCreate(
            ['email' => 'admin@mining.local'],
            ['name' => 'Admin', 'password' => bcrypt('password')]
        );
        $admin->assignRole('Admin');
    }
}
