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
        Schema::table('paies', function (Blueprint $table) {
            $table->enum('paie_status', ['PAYE', 'EN ATTENTE'])->default('EN ATTENTE');
            $table->enum('status', ['ACTIVE', 'DESACTIVE'])->default('ACTIVE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('paies', function (Blueprint $table) {
            //
        });
    }
};
