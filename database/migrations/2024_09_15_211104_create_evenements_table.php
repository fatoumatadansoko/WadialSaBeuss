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
        Schema::create('evenements', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('description')->nullable();
            $table->date('event_date');
            $table->string('lieu');
            $table->enum('type', ['mariage', 'anniversaire', 'bapteme', 'seminaire', 'bridal shower', 'after work', 'graduation','ceremonie']); // Enum pour le type d'événement
            $table->enum('budget', ['moins de 500000', '500000 à 1000000', 'plus de 1000000']); // Enum pour les plages de budget
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Assure-toi que cette ligne est présente
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evenements');
    }
};
