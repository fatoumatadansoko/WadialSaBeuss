<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


    class CreateDemandePrestationTable extends Migration
    {
        public function up()
        {
                Schema::create('demandeprestations', function (Blueprint $table) {
                    $table->id();
                    $table->enum('etat', ['en_attente', 'approuve', 'rejete'])->default('en_attente');
                    $table->foreignId('prestataire_id')
                        ->constrained('prestataires')
                        ->onDelete('cascade'); // Clé étrangère vers la table prestataires
                    $table->foreignId('user_id')
                        ->constrained('users') // Adaptez si nécessaire
                        ->onDelete('cascade'); // Clé étrangère vers la table users
                    $table->string('message')->nullable(); 
                    $table->timestamps(); // Ajoute created_at et updated_at
                });
            }
        

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demandeprestation');
    }
};
