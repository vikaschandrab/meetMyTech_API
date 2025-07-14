<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserActivitiesTable extends Migration
    {
    public function up()
    {
        Schema::create('user_activities', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->index(); // FK to users table
            $table->string('action');
            $table->text('description')->nullable();
            $table->json('professional_skills')->nullable(); // Store skills in JSON

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_activities');
    }
}
