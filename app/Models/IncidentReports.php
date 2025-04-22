<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncidentReports extends Model
{
    protected $table = 'incident_reports';
    protected $fillable = ['resident_origin_id', 'barangay_employee_id', 'report_date', 'remarks', 'status'];

    public function resident() {
        return $this->belongsTo(Resident::class, 'resident_origin_id');
    }

    public function reportedBy() {
        return $this->belongsTo(BarangayEmployee::class, 'barangay_employee_id');
    }
}
