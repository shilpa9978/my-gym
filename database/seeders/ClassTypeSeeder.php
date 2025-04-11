<?php

namespace Database\Seeders;

use App\Models\ClassType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClassTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClassType::create([
            'name' => 'Yoga',
            'description' => fake()->text(),
            'duration' => 60
        ]);
        ClassType::create([
            'name' => 'Dance Fitness',
            'description' => fake()->text(),
            'duration' => 45
        ]);
        ClassType::create([
            'name' => 'Pilates',
            'description' => fake()->text(),
            'duration' => 60
        ]);
        ClassType::create([
            'name' => 'Boxing',
            'description' => fake()->text(),
            'duration' => 50
        ]);
    }
}
