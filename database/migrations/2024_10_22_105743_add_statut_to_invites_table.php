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
    Schema::table('invites', function (Blueprint $table) {
        $table->boolean('statut')->default(false)->after('nom'); // Colonne statut (false par défaut)
    });
}

public function down(): void
{
    Schema::table('invites', function (Blueprint $table) {
        $table->dropColumn('statut');
    });
}

};
