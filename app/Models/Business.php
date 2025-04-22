<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = ['owner_id', 'business_type_id', 'business_name', 'address'];

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
