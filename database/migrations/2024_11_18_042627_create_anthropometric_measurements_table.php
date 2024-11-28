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
        Schema::create('anthropometric_measurements', function (Blueprint $table) {
            $table->id();
            $table->float('weight');
            $table->float('height');
            $table->float('bmi');
            $table->unsignedBigInteger('patient_id'); // Referencia al paciente
            $table->timestamps();
            $table->foreign('patient_id')->references('id')->on('users')->onDelete('cascade'); // Referencia a la tabla 'patients'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anthropometric_measurements');
    }
};
