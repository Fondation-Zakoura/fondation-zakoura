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
        Schema::table('projects',function(Blueprint $table){
            $table->unsignedBigInteger('project_type_id')->change();
            $table->unsignedBigInteger('project_status_id')->change();
            $table->string('project_name')->after('id')->change();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
