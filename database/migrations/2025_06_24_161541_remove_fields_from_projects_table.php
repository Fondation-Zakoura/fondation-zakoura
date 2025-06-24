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
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['type_du_partenaire', 'structure_du_partenaire','quote_part_partenaire','banque','agence_bancaire','rib']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->enum('type_du_partenaire', ['Opérationnel', 'Institutionnel', 'Expérimental']);
            $table->enum('structure_du_partenaire', ['Publique', 'Privée', 'Associative', 'Coopérative']);
            $table->decimal('quote_part_partenaire', 15, 2)->nullable();
            $table->enum('banque', ['BMCE', 'CIH', 'BOA', 'Attijari']);
            $table->string('agence_bancaire');
            $table->string('rib', 34);
        });
    }
};
