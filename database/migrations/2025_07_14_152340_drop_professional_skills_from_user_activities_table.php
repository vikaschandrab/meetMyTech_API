<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('user_activities', function (Blueprint $table) {
            $table->dropColumn('professional_skills');
        });
    }

    public function down(): void
    {
        Schema::table('user_activities', function (Blueprint $table) {
            $table->json('professional_skills')->nullable(); // Add back the column if rolled back
        });
    }
};

