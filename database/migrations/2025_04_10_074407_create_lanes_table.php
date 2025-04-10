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
        Schema::create('lanes', function (Blueprint $table) {
            $table->id();
            $table->integer('lane_number')->unique();
            $table->foreignId('score_id')->nullable()->constrained('scores')->nullOnDelete();
            $table->boolean('is_available')->default(true);
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lanes');
    }
};
