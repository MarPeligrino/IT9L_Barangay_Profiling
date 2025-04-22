<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessPermit extends Model
{
    protected $table = 'business_permits';
    protected $fillable = ['business_id', 'barangay_employee_id', 'issued_date', 'expiry_date', 'status'];

    public function business() {
        return $this->belongsTo(Business::class);
    }

    public function issuedBy() {
        return $this->belongsTo(BarangayEmployee::class, 'barangay_employee_id');
    }
}
