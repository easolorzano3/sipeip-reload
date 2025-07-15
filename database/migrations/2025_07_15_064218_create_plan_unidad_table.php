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
        Schema::create('plan_unidad', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_institucional_id')->constrained('plan_institucionales')->onDelete('cascade');
            $table->foreignId('unidad_organizacional_id')->constrained('unidad_organizacionales')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_unidad');
    }
};
