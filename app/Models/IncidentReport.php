<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncidentReport extends Model
{
    protected $table = 'incident_reports';
    protected $fillable = [
        'BarangayEmployeeID',
        'Report Date',
        'Remarks',
        'Status',
    ];

    // Relationships

    public function residents()
    {
        return $this->belongsToMany(Resident::class, 'incident_report_party')
                    ->withPivot('role')
                    ->withTimestamps();
    }

    public function barangayEmployee()
    {
        return $this->belongsTo(BarangayEmployee::class, 'BarangayEmployeeID', 'ID');
    }
}
