<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['category' => 'Uncategorized'],
            ['category' => 'Technical question'],
            ['category' => 'Billing/Payments'],
        ];

        foreach ($data as $category) {
            Categories::create([
                'categories_name' => $category['category'],
            ]);
        }
    }
}
