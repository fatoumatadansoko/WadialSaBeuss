<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('invites', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('carte_personnalisee_id');
            $table->unsignedBigInteger('user_id'); // L'utilisateur (client) qui envoie l'invitation
            $table->string('email'); // Email de l'invité
            $table->timestamps();
    
            // Clés étrangères
            $table->foreign('carte_personnalisee_id')->references('id')->on('carte_personnalisees')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invites');
    }
};
