<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyEducationDetailsDateColumns extends Migration
{
    public function up()
    {
        Schema::table('education_details', function (Blueprint $table) {
            $table->date('from_date')->change();
            $table->date('to_date')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('education_details', function (Blueprint $table) {
            $table->year('from_date')->change();
            $table->year('to_date')->nullable()->change();
        });
    }
}
