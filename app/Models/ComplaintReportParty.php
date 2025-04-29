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
}
