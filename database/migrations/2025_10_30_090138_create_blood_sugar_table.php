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

            
            $table->float('sugar_level');

            
            $table->enum('unit', ['mmol/L', 'mg/dL']);

            
            $table->string('measurement_time'); 

            
            $table->enum('measured_at', ['Morning', 'Noon', 'Afternoon', 'Evening', 'Night']);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blood_sugar_records');
    }
};
