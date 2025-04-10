<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $fillable = [
            'player_name',
            'score_value',
            'round_number',
            'game_date',
            'reservation_id',
            'lane_id',
            // Frame throws
            'frame_1_throw_1', 'frame_1_throw_2',
            'frame_2_throw_1', 'frame_2_throw_2',
            'frame_3_throw_1', 'frame_3_throw_2',
            'frame_4_throw_1', 'frame_4_throw_2',
            'frame_5_throw_1', 'frame_5_throw_2',
            'frame_6_throw_1', 'frame_6_throw_2',
            'frame_7_throw_1', 'frame_7_throw_2',
            'frame_8_throw_1', 'frame_8_throw_2',
            'frame_9_throw_1', 'frame_9_throw_2',
            'frame_10_throw_1', 'frame_10_throw_2', 'frame_10_throw_3',  
    ];

    /**
     * Get the reservation that owns the score.
     */
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    /**
     * Get the lane that the score belongs to.
     */
    public function lane()
    {
        return $this->belongsTo(Lane::class);
    }
}
