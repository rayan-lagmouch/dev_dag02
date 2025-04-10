<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_id',
        'emergency_contact_name',
        'emergency_contact_phone',
        'address',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',  // Ensure is_active is treated as a boolean
    ];


    // Define the relationship with Person
    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
