<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();

            // Foreign key to users table
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // SEO Fields
            $table->text('seo_description')->nullable();
            $table->text('seo_keywords')->nullable();

            // Logo file paths
            $table->string('logo_jpeg')->nullable();
            $table->string('logo_png')->nullable();
            $table->string('logo_72_72_png')->nullable();
            $table->string('logo_114_114_png')->nullable();
            $table->string('logo_69_64_png')->nullable();
            $table->string('logo_16_14_png')->nullable();
            $table->string('logo_16_14_ico')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('site_settings');
    }
}
