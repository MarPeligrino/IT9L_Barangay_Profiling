<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barangay_Clearance extends Model
{
    protected $fillable = ['resident_id', 'barangay_employee_id', 'clearance_type_id', 'purpose', 'issued_date', 'status'];

    public function resident() {
        return $this->belongsTo(Resident::class);
    }

    public function type() {
        return $this->belongsTo(Clearance_Type::class, 'clearance_type_id');
    }

    public function issuedBy() {
        return $this->belongsTo(Barangay_Employee::class, 'barangay_employee_id');
    }
}
