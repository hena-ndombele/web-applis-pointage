<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('document_models', function (Blueprint $table) {
            $table->id();
            $table->string('Fichiers');
            $table->foreignId('agent_id')->constrained()->onCascade('delete')->onUpdate("cascade");
            $table->date('Date');
            $table->string('Description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_models');
    }
};
