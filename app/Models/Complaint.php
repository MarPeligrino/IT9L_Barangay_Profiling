<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = ['complainant_id', 'respondent_id', 'incident_id', 'barangay_employee_id', 'remarks', 'status'];

    public function complainant() {
        return $this->belongsTo(Resident::class, 'complainant_id');
    }

    public function respondent() {
        return $this->belongsTo(Resident::class, 'respondent_id');
    }

    public function incident() {
        return $this->belongsTo(Incident_Reports::class);
    }

    public function handledBy() {
        return $this->belongsTo(Barangay_Employee::class, 'barangay_employee_id');
    }
}
