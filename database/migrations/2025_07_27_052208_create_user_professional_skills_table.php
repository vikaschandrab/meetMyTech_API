<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfessionalSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_professional_skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Professional Skills
            $table->unsignedTinyInteger('communication')->default(100);
            $table->unsignedTinyInteger('team_work')->default(100);
            $table->unsignedTinyInteger('project_management')->default(100);
            $table->unsignedTinyInteger('creativity')->default(100);
            $table->unsignedTinyInteger('team_management')->default(100);
            $table->unsignedTinyInteger('active_participation')->default(100);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_professional_skills');
    }
}
