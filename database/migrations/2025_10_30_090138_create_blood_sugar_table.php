<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blood_sugar_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Blood sugar value
            $table->float('sugar_level');

            // Unit of measurement (standard medical units)
            $table->enum('unit', ['mmol/L', 'mg/dL'])->default('mmol/L');

            // When the reading was taken
            $table->enum('measurement_type', [
                'Fasting', 
                'Before Meal', 
                'After Meal', 
                'Random', 
                'Before Sleep'
            ])->default('Random');

    // Timestamp for when the reading was actually taken
            $table->timestamp('measured_at')->useCurrent();


            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blood_sugar_records');
    }
};
