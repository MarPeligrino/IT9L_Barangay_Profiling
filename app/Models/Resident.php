<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    protected $fillable = [
        'household_id', 'family_role_id', 'first_name', 'middle_name', 'last_name',
        'age', 'sex', 'address', 'birthday', 'civil_status', 'contact_number', 'occupation'
    ];

    public function household() {
        return $this->belongsTo(Household::class);
    }

    public function familyRole() {
        return $this->belongsTo(Family_Role::class);
    }
}
