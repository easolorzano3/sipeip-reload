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
            $table->string('entidad')->after('id');
            $table->string('nivel')->after('entidad');
            $table->string('codigo_institucional')->after('nivel');
            $table->string('estado_institucion')->after('codigo_institucional');//
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plan_institucionales', function (Blueprint $table) {
            $table->dropColumn(['entidad', 'nivel', 'codigo_institucional', 'estado_institucion']);//
        });
    }
};
