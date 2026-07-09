<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pre_registrations', function (Blueprint $table) {
            // Campo de vida corta: se escribe en createUserAndProject() y se borra en approve()
            // tras enviar el email. Nunca debe quedar con valor indefinidamente.
            $table->string('temp_plain_password')->nullable()->after('user_id');
        });
    }

    public function down(): void
    {
        Schema::table('pre_registrations', function (Blueprint $table) {
            $table->dropColumn('temp_plain_password');
        });
    }
};
