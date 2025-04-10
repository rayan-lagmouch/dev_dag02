<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();  // Add user_id and link to the users table
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('email', 150)->unique();
            $table->string('phone_number', 20)->nullable();
            $table->string('role', 50)->default('Customer');
            $table->timestamps();  // This will add the created_at and updated_at columns
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
