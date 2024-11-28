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
        Schema::create('patient_conditions', function (Blueprint $table) {
            // Claves foráneas
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('condition_id');
            // Clave primaria compuesta
            $table->primary(['patient_id', 'condition_id']);
            $table->timestamps();
            // Relación con la tabla patients
            $table->foreign('patient_id')->references('id')->on('users')->onDelete('cascade');

            // Relación con la tabla medical_conditions
            $table->foreign('condition_id')->references('condition_id')->on('medical_conditions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_condition');
    }
};
