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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key referencing users table
            $table->string('title');
            $table->text('description')->nullable(); // Allow null descriptions
            $table->boolean('completed')->default(false); // Default to false
            $table->timestamps(); // Timestamps for created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
