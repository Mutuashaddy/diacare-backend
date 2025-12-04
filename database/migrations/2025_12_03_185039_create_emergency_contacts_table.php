<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('emergency_contacts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');

            $table->string('caregiver_name')->nullable();
            $table->string('caregiver_number')->nullable();

            $table->string('doctor_name')->nullable();
            $table->string('doctor_number')->nullable();

            $table->string('hospital_name')->nullable();
            $table->string('hospital_number')->nullable();
            $table->string('hospital_location')->nullable();

            $table->timestamps();

            // Link to users table
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('emergency_contacts');
    }
};
