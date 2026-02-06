<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    public function run(): void
    {
        $levels = [
            [
                'name' => 'Pemula',
                'order' => 1,
                'xp_required' => 0,
                'icon' => '🌱',
                'color' => 'success',
            ],
            [
                'name' => 'Menengah',
                'order' => 2,
                'xp_required' => 500,
                'icon' => '🌿',
                'color' => 'info',
            ],
            [
                'name' => 'Mahir',
                'order' => 3,
                'xp_required' => 1500,
                'icon' => '🌳',
                'color' => 'warning',
            ],
        ];

        foreach ($levels as $level) {
            Level::create($level);
        }
    }
}
