<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('plan_institucionales', function (Blueprint $table) {
            $table->enum('estado', ['borrador', 'en_revision', 'aprobado'])->default('borrador');
        });
    }

    public function down(): void
    {
        Schema::table('plan_institucionales', function (Blueprint $table) {
            $table->dropColumn('estado');
        });
    }
};
