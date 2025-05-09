<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComplaintReportParty extends Model
{
    protected $fillable = [
        'ComplaintID',
        'ResidentID',
        'Role',
    ];

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }

    public function complaintReport()
    {
        return $this->belongsTo(Complaint::class, 'complaint_id');
    }
}
