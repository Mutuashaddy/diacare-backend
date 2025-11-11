<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blood_pressure_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Core readings
            $table->integer('systolic');   // e.g., 120 (upper number)
            $table->integer('diastolic');  // e.g., 80 (lower number)
            $table->integer('heart_rate')->nullable(); // beats per minute (BPM)

            // Unit (use mmHg, the international standard)
            $table->enum('unit', ['mmHg'])->default('mmHg');

            // Measurement context — used in real clinics and research
            $table->enum('measurement_position', [
                'Sitting',
                'Standing',
                'Lying Down'
            ])->default('Sitting');

            $table->enum('measurement_arm', [
                'Left Arm',
                'Right Arm'
            ])->default('Left Arm');

            // When  the reading was taken
            $table->enum('measurement_type', [
                'Morning',
                'Evening',
                'Before Medication',
                'After Medication',
                'Random'
            ])->default('Random');

            // Timestamp for when the reading was actually taken
            $table->timestamp('measured_at')->useCurrent();

         

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blood_pressure_records');
    }
};
