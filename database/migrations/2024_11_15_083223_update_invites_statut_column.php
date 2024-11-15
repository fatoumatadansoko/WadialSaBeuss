<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateInvitesStatutColumn extends Migration
{
    public function up()
    {
        Schema::table('invites', function (Blueprint $table) {
            // Création de la colonne temporaire
            $table->string('new_statut')->nullable()->after('statut');
        });

        // Migration des données vers la nouvelle colonne
        DB::table('invites')->update([
            'new_statut' => DB::raw("CASE 
                WHEN statut = 0 THEN 'en_attente'
                WHEN statut = 1 THEN 'accepte'
                WHEN statut = 2 THEN 'refuse'
                ELSE 'en_attente' 
            END")
        ]);

        Schema::table('invites', function (Blueprint $table) {
            // Suppression de l'ancienne colonne
            $table->dropColumn('statut');
            // Renommage de la nouvelle colonne
            $table->renameColumn('new_statut', 'statut');
            // Modification du type et des contraintes
            $table->string('statut')->default('en_attente')->change();
        });
    }

    public function down()
    {
        Schema::table('invites', function (Blueprint $table) {
            // Création d'une colonne temporaire pour la conversion inverse
            $table->integer('new_statut')->nullable()->after('statut');
        });

        // Conversion inverse des données
        DB::table('invites')->update([
            'new_statut' => DB::raw("CASE 
                WHEN statut = 'en_attente' THEN 0
                WHEN statut = 'accepte' THEN 1
                WHEN statut = 'refuse' THEN 2
                ELSE 0 
            END")
        ]);

        Schema::table('invites', function (Blueprint $table) {
            // Suppression de l'ancienne colonne
            $table->dropColumn('statut');
            // Renommage de la nouvelle colonne
            $table->renameColumn('new_statut', 'statut');
            // Ajout des contraintes
            $table->integer('statut')->default(0)->change();
        });
    }
}