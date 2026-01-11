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
        Schema::create('interview_questions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->text('question');

            $table->longText('answer')->nullable();

            $table->enum('level', ['junior', 'mid', 'senior'])
                ->default('junior');

            $table->string('category', 100)
                ->nullable()
                ->index();

            $table->timestamps();

            // Optional but useful indexes
            $table->index('level');
            $table->index(['user_id', 'category']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interview_questions');
    }
};
