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
        Schema::create('schedule_classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('instructor_id')->constrained('users');
            $table->foreignId('class_type_id')->constrained('class_types');
            $table->datetime('date_time')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_classes');
    }
};
