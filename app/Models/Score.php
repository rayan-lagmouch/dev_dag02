<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    // Fillable attributes
    protected $fillable = [
        'game_date',
        'player_name',
        'score_value',
        'frame_details',
    ];

    // Define the relationship with Person
    public function person()
    {
        return $this->belongsTo(Person::class, 'player_name', 'first_name'); // Adjust based on how player_name relates to Person model
    }

    // Define the relationship with Lane
    public function lane()
    {
        return $this->hasOne(Lane::class, 'score_id');
    }
}
