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
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('postnom');
            $table->string('token');
            $table->string('prenom');
            $table->date('date_n');
            $table->string('numero');
            $table->string('email');
            $table->string('adresse');
            $table->bigInteger('direction_id');
            $table->bigInteger('departement_id');
            $table->integer('service_id');
            $table->string('matricule')->nullable();
            $table->string('superviseur');
            $table->date('date_e');
            $table->string('etat_civil');
            $table->integer('nombre_e');
            $table->string('niveau_etude');
            $table->string('image');
            $table->string('grade');
            $table->string('fonction');
            $table->string('sexe');
            $table->string('conge_utilises')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agents');
    }
};
