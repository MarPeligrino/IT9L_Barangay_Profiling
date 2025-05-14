<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangayCertificate extends Model
{
    protected $table = 'barangay_certificates';
    protected $fillable = ['resident_id', 'barangay_employee_id', 'certificate_type_id', 'purpose', 'issued_date', 'status'];

    public function resident() {
        return $this->belongsTo(Resident::class);
    }

    public function certificateType() {
        return $this->belongsTo(CertificateType::class, 'certificate_type_id');
    }

    public function barangayEmployee() {
        return $this->belongsTo(BarangayEmployee::class);
    }
}
