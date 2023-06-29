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
        Schema::create('bssids', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('bssid');
            $table->string('qr_code_1');
            $table->string('qr_code_2');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bssids');
    }
};
