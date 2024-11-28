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
        Schema::create('ia_recommendations', function (Blueprint $table) {
            $table->id('recommendation_ia_id');
            $table->longText('description'); // Use longText for larger text storage
            $table->date('date');
            $table->string('type');
            $table->unsignedBigInteger('consultation_id');
            $table->timestamps();

            // Foreign key relationship
            $table->foreign('consultation_id')->references('consultation_id')->on('consultations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ia_recommendations');
    }
};
