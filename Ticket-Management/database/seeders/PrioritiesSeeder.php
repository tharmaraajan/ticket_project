<?php

namespace Database\Seeders;

use App\Models\Priorities;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrioritiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['priority' => 'High'],
            ['priority' => 'Medium'],
            ['priority' => 'Low'],
        ];

        foreach ($data as $priority) {
            Priorities::create([
                'priority_name' => $priority['priority'],
            ]);
        }
    }
}
