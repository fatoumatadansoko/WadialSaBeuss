<?php
// database/migrations/xxxx_xx_xx_xxxxxx_refresh_evenements_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RefreshEvenementsTable extends Migration
{
    public function up()
    {
        // Supprimer la table si elle existe
        Schema::dropIfExists('evenements');

        // Créer la table
        Schema::create('evenements', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->date('event_date');
            $table->string('lieu');
            $table->string('type');
            $table->string('budget');
            $table->unsignedBigInteger('user_id'); // Clé étrangère pour l'utilisateur
            $table->timestamps();

            // Ajoutez la contrainte de clé étrangère
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('evenements');
    }
}
