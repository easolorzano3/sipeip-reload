<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('plan_institucionales', function (Blueprint $table) {
            //$table->date('anio_inicio')->nullable();
            //$table->date('anio_fin')->nullable();
        });
    }

    public function down(): void {
        Schema::table('plan_institucionales', function (Blueprint $table) {
            //$table->dropColumn(['anio_inicio', 'anio_fin']);
        });
    }
};
