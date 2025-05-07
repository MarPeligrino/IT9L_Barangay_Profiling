<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurrentAddress extends Model
{
    protected $fillable = [
        'purok',
        'house_number',
        'street_name',
        'village',
        'barangay',
        'city',
        'province',
        'postal_code'
    ];

    public function residents()
    {
        return $this->hasMany(Resident::class, 'current_address_id');
    }
}
