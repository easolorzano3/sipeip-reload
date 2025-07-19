<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEstadoIdToPlanInstitucionalesTable extends Migration
{
    public function up(): void
    {
        Schema::table('plan_institucionales', function (Blueprint $table) {
            $table->unsignedBigInteger('estado_id')->after('unidad_id')->default(1);
            $table->foreign('estado_id')->references('id')->on('estado_plans');
        });
    }

    public function down(): void
    {
        Schema::table('plan_institucionales', function (Blueprint $table) {
            $table->dropForeign(['estado_id']);
            $table->dropColumn('estado_id');
        });
    }
}
