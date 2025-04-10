<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['person_id', 'order_time', 'total_amount', 'payment_method', 'status', 'packages'];

    protected $casts = [
        'order_time' => 'datetime',
    ];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    // Accessor to convert the string back to an array
    public function getPackagesAttribute($value)
    {
        return $value ? explode(',', $value) : [];
    }
}

