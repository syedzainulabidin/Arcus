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
        Schema::create('friend_requests', function (Blueprint $table) {
            $table->id(); // Primary key for the friend_requests table
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade'); // Foreign key to users table (sender)
            $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade'); // Foreign key to users table (receiver)
            $table->enum('status', ['pending', 'accepted', 'declined'])->default('pending'); // Request status
            $table->timestamps(); // Created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('friend_requests');
    }
};