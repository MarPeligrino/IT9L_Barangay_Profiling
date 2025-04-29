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
}
