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
        Schema::create('consultations', function (Blueprint $table) {
            $table->id('consultation_id'); // Identificador único de la consulta
            $table->unsignedBigInteger('patient_id'); // Referencia al paciente
            $table->unsignedBigInteger('target_type_id'); // Referencia al tipo de objetivo
            $table->unsignedBigInteger('anthropometric_measurement_id'); // Referencia a las medidas antropométricas
            $table->date('date');
            $table->string('dietary_preference')->nullable();
            $table->string('physical_activity_level');
            $table->text('restrictions')->nullable();
            $table->timestamps();

            // Llaves foráneas
            $table->foreign('patient_id')->references('id')->on('users')->onDelete('cascade'); // Referencia a la tabla 'patients'
            $table->foreign('target_type_id')->references('target_type_id')->on('target_types')->onDelete('cascade'); // Referencia a la tabla 'target_types'
            $table->foreign('anthropometric_measurement_id')->references('id')->on('anthropometric_measurements')->onDelete('cascade'); // Referencia a la tabla 'anthropometric_measurements'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
