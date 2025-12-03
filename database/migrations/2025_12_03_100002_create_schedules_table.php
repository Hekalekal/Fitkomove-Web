<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('activity_type'); // running, cycling, workout, etc
            $table->date('scheduled_date');
            $table->time('scheduled_time');
            $table->integer('duration_minutes')->nullable();
            $table->text('notes')->nullable();
            $table->enum('status', ['pending', 'completed', 'skipped'])->default('pending');
            $table->boolean('is_recurring')->default(false);
            $table->string('recurring_days')->nullable(); // e.g., "mon,wed,fri"
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
