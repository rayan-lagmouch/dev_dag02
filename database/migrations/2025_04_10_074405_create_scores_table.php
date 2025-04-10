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

            $table->string('player_name');
            $table->unsignedInteger('score_value'); // Total game score

            // Store frame-by-frame throw data (for 10 frames)
            for ($i = 1; $i <= 10; $i++) {
                $table->unsignedTinyInteger("frame_{$i}_throw_1")->nullable();
                $table->unsignedTinyInteger("frame_{$i}_throw_2")->nullable();
            }

            // Optional: additional throws in the 10th frame
            $table->unsignedTinyInteger('frame_10_throw_3')->nullable();

            $table->unsignedInteger('round_number')->nullable();
            $table->dateTime('game_date')->nullable();

            $table->unsignedBigInteger('reservation_id')->nullable();
            $table->unsignedBigInteger('lane_id')->nullable();

            $table->timestamps();

            // Optional: add foreign key constraints if related tables exist
            // $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('set null');
            // $table->foreign('lane_id')->references('id')->on('lanes')->onDelete('set null');
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
