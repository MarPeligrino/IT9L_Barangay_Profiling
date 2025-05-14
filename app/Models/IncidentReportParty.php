<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncidentReportParty extends Model
{
    protected $fillable = ['incident_report_id', 'resident_id', 'role'];


    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }

    public function incidentReport()
    {
        return $this->belongsTo(IncidentReport::class);
    }
}
