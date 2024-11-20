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
        Schema::create('ejercicio_musculos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('musculoId')->constrained('muscles')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('ejercicioId')->constrained('ejercicios')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ejercicio_musculos');
    }
};
