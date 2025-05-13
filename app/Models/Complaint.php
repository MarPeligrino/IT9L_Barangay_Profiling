<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = [
        'IncidentID',
        'ComplaintID',
        'BarangayEmployeeID',
        'Remarks',
        'Status',
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
