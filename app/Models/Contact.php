<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // Fillable attributes
    protected $fillable = [
        'person_id',
        'emergency_contact_name',
        'emergency_contact_phone',
        'address',
    ];

    // Define the relationship with Person
    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
