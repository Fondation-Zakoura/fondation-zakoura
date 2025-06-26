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
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('account_id');
            $table->unsignedBigInteger('partner_id');
            $table->string('account_label');
            $table->string('bank');
            $table->string('agency')->nullable();
            $table->string('country');
            $table->string('currency');
            $table->string('account_holder');
            $table->string('rib_iban', 34);
            $table->string('bic_swift')->nullable();
            $table->date('opening_date')->nullable();
            $table->enum('status', ['Actif', 'Inactif', 'Fermé']);
            $table->text('supporting_document')->nullable();
            $table->text('comments')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('created_by');

            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_accounts');
    }
};
