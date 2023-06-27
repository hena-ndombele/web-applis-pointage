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
        Schema::create('fiches', function (Blueprint $table) {
            $table->id();
            $table->string('rubrique');
            $table->enum('type', ['FIXE', 'DYNAMIQUE']);
            $table->enum('mouvement', ['GAIN', 'RETENU']);
            $table->integer('valeur');
            $table->enum('unite', ['USD', 'CDF', '%']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fiches');
    }
};
