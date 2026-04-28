<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Laravel',
            'PHP',
            'DevOps',
            'Tips',
            'Security',
            'Web Development',
            'Linux',
            'Databases',
            'Testing',
            'Cloud',
            'Architecture',
            'Career',
        ];

        foreach ($categories as $name) {
            \App\Models\Category::create(['name' => $name]);
        }
    }
}
