<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Categories;
use App\Models\Labels;
use App\Models\Priorities;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'roles' => 'Administrator',
            'email_verified_at' => now(),
            'password' => Hash::make('admin'),
        ])->assignRole('Administrator');

        $this->call(CategoriesSeeder::class);
        $this->call(LabelsSeeder::class);
        $this->call(PrioritiesSeeder::class);
    }
}
