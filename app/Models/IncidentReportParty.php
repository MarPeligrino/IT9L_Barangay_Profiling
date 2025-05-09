<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncidentReportParty extends Model
{
    protected $fillable = [
        'IncidentReportID',
        'ResidentID',
        'Role',
    ];

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }

    public function incidentReport()
    {
        return $this->belongsTo(IncidentReport::class);
    }
}
