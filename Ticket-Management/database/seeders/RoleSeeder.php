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
        $admin = Role::create(['name' => 'Administrator']);
        $agent = Role::create(['name' => 'Agent']);
        $user = Role::create(['name' => 'Regular user']);

        $admin->givePermissionTo(['Create ticket', 'Edit ticket', 'Delete ticket']);
        $agent->givePermissionTo('Edit ticket');
        $user->givePermissionTo('Create ticket');
    }
}
