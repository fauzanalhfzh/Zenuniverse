<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            LogicProgrammingLessonSeeder::class,
            WebProgrammingLessonSeeder::class,
            MathLessonSeeder::class,
            PythonLessonSeeder::class,
        ]);
    }
}
