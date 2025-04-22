<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangayClearance extends Model
{
    protected $table = 'barangay_clearances';
    protected $fillable = ['resident_id', 'barangay_employee_id', 'clearance_type_id', 'purpose', 'issued_date', 'status'];

    public function resident() {
        return $this->belongsTo(Resident::class);
    }

    public function type() {
        return $this->belongsTo(ClearanceType::class, 'clearance_type_id');
    }

    public function issuedBy() {
        return $this->belongsTo(BarangayEmployee::class, 'barangay_employee_id');
    }
}
