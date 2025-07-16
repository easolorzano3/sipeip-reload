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
        Schema::table('plan_institucionales', function (Blueprint $table) {
            //$table->string('nivel_gobierno')->nullable();
            //$table->string('estado_institucional')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plan_institucionales', function (Blueprint $table) {
            //
        });
    }
};
