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
        Schema::table('financiamientos_proyecto', function (Blueprint $table) {
            $table->year('anio')->after('fuente_id')->nullable();
        });
    }

    public function down()
    {
        Schema::table('financiamientos_proyecto', function (Blueprint $table) {
            $table->dropColumn('anio');
        });
    }
};
