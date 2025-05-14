<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
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

    public function getFormattedAttribute()
    {
        return collect([
            $this->house_number,
            $this->street_name,
            $this->village,
            $this->purok ? 'Purok ' . $this->purok : null,
            $this->barangay,
            $this->city,
            $this->province,
            $this->postal_code
        ])->filter()->implode(', ');
    }

    public function householdResidents() {
        return $this->hasMany(Resident::class, 'household_id');
    }

    public function currentResidents() {
        return $this->hasMany(Resident::class, 'current_address_id');
    }

    public function business() {
        return $this->hasMany(Business::class, 'business_address_id');
    }

}
