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
        Schema::create('workout_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->text('notes')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('ended_at')->nullable();
            $table->integer('total_duration_seconds')->default(0);
            $table->timestamps();
        });

        Schema::create('workout_exercises', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workout_session_id')->constrained()->onDelete('cascade');
            $table->string('exercise_name');
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        Schema::create('workout_sets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workout_exercise_id')->constrained()->onDelete('cascade');
            $table->integer('set_number');
            $table->integer('reps')->nullable();
            $table->decimal('weight', 8, 2)->nullable();
            $table->string('weight_unit')->default('kg');
            $table->integer('rest_seconds')->nullable();
            $table->boolean('is_completed')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workout_sets');
        Schema::dropIfExists('workout_exercises');
        Schema::dropIfExists('workout_sessions');
    }
};
