<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('badges', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('icon'); // material symbol name
            $table->string('color_theme')->default('blue'); // to define CSS classes e.g., 'blue', 'yellow'
            $table->string('rarity')->default('Umum'); // Umum, Langka, Epik, Legenda
            $table->string('condition_type')->nullable(); // e.g., 'completed_missions', 'total_xp', 'streak_days'
            $table->integer('condition_value')->nullable(); // e.g., 5, 1000, 7
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('badges');
    }
};
