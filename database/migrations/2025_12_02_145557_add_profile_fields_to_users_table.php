<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('age')->nullable();
            $table->string('gender')->nullable();
            $table->string('job')->nullable();

            // Tambahan field Fitkomove
            $table->float('height')->nullable(); // tinggi badan
            $table->float('weight')->nullable(); // berat badan
            $table->float('target_weight')->nullable();
            $table->string('goal')->nullable(); // lose, gain, maintain
            $table->string('intensity_level')->nullable();
            $table->boolean('onboarding_completed')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'age',
                'gender',
                'job',
                'height',
                'weight',
                'target_weight',
                'goal',
                'intensity_level',
                'onboarding_completed',
            ]);
        });
    }
};
