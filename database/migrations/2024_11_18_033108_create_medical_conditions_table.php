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
        Schema::create('medical_conditions', function (Blueprint $table) {
            $table->id('condition_id');
            $table->string('name');
            $table->unsignedBigInteger('condition_type_id');
            $table->foreign('condition_type_id')
              ->references('id')
              ->on('condition_types')
              ->onDelete('cascade'); // Opcional: elimina las dependencias en cascada
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_conditions');
    }
};
