<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    // Fillable attributes
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'role',
    ];
    // Relationship with Contacts
    public function contact()
    {
        return $this->hasOne(Contact::class, 'person_id');
    }

    // Relationship with Reservations
    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'person_id');
    }
// Person Model


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // If needed, additional methods or relationships can be added.
}
