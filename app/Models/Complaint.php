<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = [
        'incident_id',
        'complaint_party_id',
        'barangay_employee_id',
        'remarks',
        'status',
    ];

    public function residents()
    {
        return $this->belongsToMany(Resident::class, 'complaint_report_party')
                    ->withPivot('role')
                    ->withTimestamps();
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
