<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurrentAddress extends Model
{
    protected $fillable = [
        'purok',
        'street_number',
        'street_name',
        'apartment_unit',
        'province',
        'postal_code',
        'country',
    ];

    public function residents()
    {
        return $this->hasMany(Resident::class, 'current_address_id');
    }
}
