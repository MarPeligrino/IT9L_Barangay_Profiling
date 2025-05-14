<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = [
        'incident_id',
        'complaint_report_party_id',
        'barangay_employee_id',
        'remarks',
        'status',
    ];

    public function parties()
    {
        return $this->hasMany(ComplaintReportParties::class);
    }

    public function barangayEmployee()
    {
        return $this->belongsTo(BarangayEmployee::class);
    }
    public function incident()
    {
        return $this->belongsTo(IncidentReport::class);
    }
}
