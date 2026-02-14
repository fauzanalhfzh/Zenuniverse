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
        Schema::table('users', function (Blueprint $table) {
            $table->string('age_group')->default('8-12')->after('email'); // Options: 4-7, 8-12, 12-16, adult
            $table->integer('current_streak')->default(0)->after('current_xp');
            $table->integer('longest_streak')->default(0)->after('current_streak');
            $table->timestamp('last_activity_at')->nullable()->after('longest_streak');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['age_group', 'current_streak', 'longest_streak', 'last_activity_at']);
        });
    }
};
