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
        Schema::create('diets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('recommendation_ia_id')->nullable();  // Relación con la consulta
            $table->string('name');
            $table->string('goal');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('daily_calories');
            $table->string('daily_proteins');
            $table->string('daily_fats');
            $table->string('daily_carbs');
            $table->timestamps();

            // Llave foránea hacia la tabla 'users'
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Relación con la tabla 'consultations'
            $table->foreign('recommendation_ia_id')->references('recommendation_ia_id')->on('ia_recommendations')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diets');
    }
};
