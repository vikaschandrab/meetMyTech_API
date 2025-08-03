<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Blog created by
            $table->string('title');
            $table->text('description');
            $table->longText('content');
            $table->string('slug')->unique();
            $table->string('featured_image')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->integer('views_count')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->string('reading_time')->nullable(); // Estimated reading time
            $table->json('tags')->nullable(); // Blog tags as JSON
            $table->timestamps();
            $table->softDeletes(); // Add soft deletes

            // Indexes for better performance
            $table->index(['user_id', 'status']);
            $table->index(['slug']);
            $table->index(['published_at']);
            $table->index(['is_featured']);

            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
