<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pre_registrations', function (Blueprint $table) {
            $table->foreignId('user_id')
                ->nullable()
                ->after('id')
                ->constrained('users')
                ->nullOnDelete();
        });

        DB::statement("ALTER TABLE pre_registrations MODIFY COLUMN status ENUM('pending','contacted','archived','approved') DEFAULT 'pending'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE pre_registrations MODIFY COLUMN status ENUM('pending','contacted','archived') DEFAULT 'pending'");

        Schema::table('pre_registrations', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
