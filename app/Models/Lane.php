<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lane extends Model
{
    use HasFactory;

    // Fillable attributes
    protected $fillable = [
        'lane_number',
        'score_id',
        'is_available',
    ];

    // Relationship with Score
    public function score()
    {
        return $this->belongsTo(Score::class);
    }

    // Relationship with Reservations
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
