<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('actividades_poa', function (Blueprint $table) {
            $table->boolean('requiere_inversion')->default(false);
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('actividades_poa', function (Blueprint $table) {
            //
        });
    }
};
