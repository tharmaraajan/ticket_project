<?php

namespace Database\Seeders;

use App\Models\Labels;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LabelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['label' => 'Bug'],
            ['label' => 'Question'],
            ['label' => 'Enchantment'],
        ];

        foreach ($data as $label) {
            Labels::create([
                'labels_name' => $label['label'],
            ]);
        }
    }
}
