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
        Schema::create('diet_goals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('day_id');
            $table->integer('completed_meals')->default(0);
            $table->boolean('goal_achieved')->default(false);
            $table->timestamps();

            // Relación con la tabla `days`
            $table->foreign('day_id')->references('id')->on('days')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diet_goals');
    }
};
