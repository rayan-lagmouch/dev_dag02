<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Fillable attributes for mass assignment
    protected $fillable = [
        'person_id',
        'order_time',
        'total_amount',
        'payment_method',
        'status',
    ];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }
    // Relationship with Reservation
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    // If you need any additional methods or custom logic, you can add them here
}
