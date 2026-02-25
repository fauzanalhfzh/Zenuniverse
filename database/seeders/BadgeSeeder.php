<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $badges = [
            [
                'name' => 'Master Keyboard',
                'description' => 'Mulai mengetik kode dengan cepat.',
                'icon' => 'keyboard',
                'color_theme' => 'yellow',
                'rarity' => 'Langka',
                'condition_type' => 'total_xp',
                'condition_value' => 500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pahlawan Coding',
                'description' => 'Selesaikan pelajaran penganar coding.',
                'icon' => 'code',
                'color_theme' => 'blue',
                'rarity' => 'Umum',
                'condition_type' => 'completed_missions',
                'condition_value' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jenius Logika',
                'description' => 'Menyelesaikan berbagai teka-teki logika.',
                'icon' => 'auto_fix_high',
                'color_theme' => 'purple',
                'rarity' => 'Epik',
                'condition_type' => 'streak_days',
                'condition_value' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Penjelajah Web',
                'description' => 'Eksplorasi dunia internet.',
                'icon' => 'language',
                'color_theme' => 'orange',
                'rarity' => 'Umum',
                'condition_type' => 'completed_missions',
                'condition_value' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pawang Robot',
                'description' => 'Mengendalikan robot canggih.',
                'icon' => 'smart_toy',
                'color_theme' => 'slate',
                'rarity' => 'Legenda',
                'condition_type' => 'total_xp',
                'condition_value' => 5000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('badges')->insert($badges);
    }
}
