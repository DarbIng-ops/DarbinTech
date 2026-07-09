<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('stage', [
                'briefing',
                'wireframe',
                'diseno_ui',
                'desarrollo',
                'revision',
                'listo_para_entrega',
                'entregado',
            ])->default('briefing');
            $table->tinyInteger('progress')->unsigned()->default(0);
            $table->tinyInteger('revisions_allowed')->unsigned()->default(1);
            $table->tinyInteger('revisions_used')->unsigned()->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
