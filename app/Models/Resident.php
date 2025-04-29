<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    protected $fillable = [
        'household_id',
        'family_role_id',
        'current_address_id',
        'first_name',
        'middle_name',
        'last_name',
        'age',
        'sex',
        'birthday',
        'civil_status',
        'contact_number',
        'occupation',
        'nationality',
        'religion'
    ];

    public function household()
    {
        return $this->belongsTo(Household::class);
    }

    public function incidentReports()
    {
        return $this->belongsToMany(IncidentReport::class, 'incident_report_party')
                    ->withPivot('role')
                    ->withTimestamps();
    }

    public function complaintReports()
    {
        return $this->belongsToMany(Complaint::class, 'complaint_report_party')
                    ->withPivot('role')
                    ->withTimestamps();
    }

    public function currentAddress()
    {
        return $this->belongsTo(CurrentAddress::class, 'current_address_id');
    }

    public function familyRole()
    {
        return $this->belongsTo(FamilyRole::class, 'family_role_id');
    }
}
