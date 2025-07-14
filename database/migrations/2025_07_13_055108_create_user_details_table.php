<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'user_details',
            function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id')->index();
                $table->string('address')->nullable();
                $table->string('facebook_profile')->nullable();
                $table->string('instagram_profile')->nullable();
                $table->string('linkedin_profile')->nullable();
                $table->string('whatsapp_number')->nullable();
                $table->text('about')->nullable(); // user description
                $table->string('technologies')->nullable(); // comma-separated values
                $table->string('resume_filename')->nullable(); // store uploaded file name
                $table->timestamps();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_details');
    }
}
