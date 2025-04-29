<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermitTransaction extends Model
{
    protected $fillable = [
        'PermitID',
        'AmountPaid',
        'PaymentDate',
        'PaymentStatus',
    ];

    public function businessPermit()
    {
        return $this->belongsTo(BusinessPermit::class);
    }
}
