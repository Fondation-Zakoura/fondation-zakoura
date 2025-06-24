<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('partenaires', function (Blueprint $table) {
            $table->id();
            $table->string('nom_partenaire')->unique(); // 
            $table->string('abreviation', 5); // 
            $table->string('telephone')->nullable();
            $table->string('email')->nullable()->unique();
            $table->enum('type_partenaire', ['National', 'International']); // 
            $table->foreignId('nature_partenaire_id')->constrained('nature_partenaires');
            $table->foreignId('structure_partenaire_id')->constrained('structure_partenaires');
            $table->foreignId('statut_id')->constrained('statut_partenaires');
            $table->text('actions')->nullable();
            $table->text('adresse')->nullable();
            $table->string('pays')->nullable();
            $table->text('note')->nullable();
            $table->string('logo_partenaire')->nullable(); // Chemin vers le fichier
            $table->foreignId('cree_par_id')->constrained('users'); // L'utilisateur qui l'a créé
            $table->timestamps(); // Gère date_de_creation
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('partenaires');
    }
};
