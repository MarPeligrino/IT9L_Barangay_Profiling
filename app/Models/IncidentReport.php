<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class IncidentReport extends Model
{
    protected $table = 'incident_reports';

    protected $fillable = [
        'barangay_employee_id',
        'report_date',
        'remarks',
        'status',
    ];

    // Relationships

    public function residents(): BelongsToMany
    {
        return $this->belongsToMany(Resident::class, 'incident_report_party')
                    ->withPivot('role')
                    ->withTimestamps();
    }

    public function barangayEmployee(): BelongsTo
    {
        return $this->belongsTo(BarangayEmployee::class);
    }

        public function parties()
    {
        return $this->hasMany(IncidentReportParty::class);
    }

}
