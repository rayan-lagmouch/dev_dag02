<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_date', 'player_name', 'score_value', 'frame_details', 'reservation_id', 'lane_id', 'is_completed'
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
