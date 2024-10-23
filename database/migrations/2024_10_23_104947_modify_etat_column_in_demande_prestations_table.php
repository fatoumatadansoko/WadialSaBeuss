<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyEtatColumnInDemandePrestationsTable extends Migration
{
    public function up()
    {
        Schema::table('demande_prestations', function (Blueprint $table) {
            // Modifiez la colonne 'etat' pour l'énumération souhaitée
            $table->enum('etat', ['en_attente', 'approuvée', 'rejetée'])
                  ->default('en_attente')
                  ->change();
        });
    }

    public function down()
    {
        Schema::table('demande_prestations', function (Blueprint $table) {
            // Revenez à l'ancien type d'énumération
            $table->enum('etat', ['en_attente', 'approuve', 'rejete'])
                  ->default('en_attente')
                  ->change();
        });
    }
}
