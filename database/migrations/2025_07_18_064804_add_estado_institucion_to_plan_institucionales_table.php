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
        Schema::table('plan_institucionales', function (Blueprint $table) {
            $table->string('estado_institucion')->default('Activo');
        });
    }

    public function down()
    {
        Schema::table('plan_institucionales', function (Blueprint $table) {
            $table->dropColumn('estado_institucion');
        });
    }

};
