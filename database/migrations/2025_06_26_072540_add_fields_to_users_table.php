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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('unidad_organizacional_id')->after('password');
            $table->foreign('unidad_organizacional_id')->references('id')->on('unidad_organizacionales');

            $table->enum('estado', ['activo', 'inactivo'])->default('activo')->after('unidad_organizacional_id');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['unidad_organizacional_id']);
            $table->dropColumn(['unidad_organizacional_id', 'estado']);
        });

    }
};
