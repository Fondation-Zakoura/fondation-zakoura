<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('personnes_contact', function (Blueprint $table) {
            $table->id();
            $table->foreignId('partenaire_id')->constrained()->onDelete('cascade'); // Lié à un partenaire
            $table->string('nom'); // 
            $table->string('prenom'); // 
            $table->string('poste'); // 
            $table->string('email')->unique();
            $table->string('telephone');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('personnes_contact');
    }
};