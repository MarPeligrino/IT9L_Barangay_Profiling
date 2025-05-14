<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComplaintParty extends Model
{
    protected $fillable = [
        'complaint_report_id',
        'resident_id',
        'role',
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
