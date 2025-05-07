<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = ['owner_id', 'business_type_id', 'business_name', 'house_number','street_name','village','barangay','city','province','postal_code'];

    public function owner() {
        return $this->belongsTo(Resident::class, 'owner_id');
    }

    public function type() {
        return $this->belongsTo(BusinessType::class, 'business_type_id');
    }

    public function permit() {
        return $this->hasMany(BusinessPermit::class, 'business_permit_id');
    }
}
