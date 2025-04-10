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
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->timestamp('game_date')->useCurrent();
            $table->foreignId('player_id')->constrained('players');
            $table->integer('score_value');
            $table->string('frame_details', 100)->nullable();
            $table->string('game_type')->nullable();  // e.g., "1v1", "team"
            $table->integer('round_number')->nullable();
            $table->boolean('is_winner')->default(false);  // true if player won
            $table->foreignId('match_id')->nullable()->constrained('matches');  // match group
            $table->integer('game_duration_seconds')->nullable();  // duration in seconds
            $table->json('score_breakdown')->nullable();  // breakdown of scores
            $table->timestamps();  // created_at and updated_at fields
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scores');
    }
};
