<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    // Fillable attributes
    protected $fillable = [
        'person_id',
        'lane_id',
        'reservation_date',
        'start_time',
        'end_time',
        'number_of_players',
    ];

    // Relationship with Person
    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    // Relationship with Lane
    public function lane()
    {
        return $this->belongsTo(Lane::class);
    }
}
