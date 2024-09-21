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
        Schema::create('taches', function (Blueprint $table) {
            $table->id();
            $table->string('nom'); // Colonne pour le nom de la tâche
            $table->text('description')->nullable(); // Colonne pour la description de la tâche (optionnelle)
            $table->boolean('termine')->default(false); // Colonne pour indiquer si la tâche est terminée
            $table->integer('priorite')->default(1); // Colonne pour la priorité de la tâche
            $table->date('date_limite')->nullable(); // Colonne pour la date limite (optionnelle)
            $table->timestamps();
        });

        Schema::table('tache', function (Blueprint $table) {
            $table->boolean('termine')->default(false);
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taches');
    }
};
