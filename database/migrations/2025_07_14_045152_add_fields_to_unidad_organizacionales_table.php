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
        Schema::table('unidad_organizacionales', function (Blueprint $table) {
                    $table->string('codigo')->nullable()->after('nombre');
                    $table->string('estado')->default('activo')->after('codigo');
                    $table->unsignedBigInteger('unidad_padre_id')->nullable()->after('estado');
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('unidad_organizacionales', function (Blueprint $table) {
            $table->dropColumn(['codigo', 'estado', 'unidad_padre_id']);
            //
        });
    }
};
