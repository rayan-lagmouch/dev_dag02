<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;  // Import Carbon class

class Score extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_date',
        'player_name',
        'score_value',
        'frame_details',
    ];

    // Cast 'game_date' to Carbon instance
    protected $casts = [
        'game_date' => 'datetime',  // This will automatically cast the game_date to a Carbon instance
    ];

    // Define the relationship with Person
    public function person()
    {
        return $this->belongsTo(Person::class, 'player_name', 'first_name');
    }

    // Define the relationship with Lane
    public function lane()
    {
        return $this->hasOne(Lane::class, 'score_id');
    }
}
