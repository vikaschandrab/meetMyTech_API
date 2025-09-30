<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mock_interviews', function (Blueprint $table) {
            $table->enum('status', ['pending', 'accepted', 'rejected', 'completed'])
                ->default('pending')
                ->after('notes');
            $table->string('meeting_link')->nullable()->after('status');
            $table->string('meeting_id')->nullable()->after('meeting_link');
            $table->text('admin_notes')->nullable()->after('meeting_id');
            $table->unsignedBigInteger('created_by')->nullable()->after('admin_notes');
            $table->integer('duration')->default(30)->after('created_by');
        });
    }

    public function down(): void
    {
        Schema::table('mock_interviews', function (Blueprint $table) {
            $table->dropColumn([
                'status',
                'meeting_link',
                'meeting_id',
                'admin_notes',
                'created_by',
                'duration'
            ]);
        });
    }
};
