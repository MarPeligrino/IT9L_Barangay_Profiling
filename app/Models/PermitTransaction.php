<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermitTransaction extends Model
{
    protected $fillable = [
        'business_permit_id',
        'amount_paid',
        'payment_date',
        'payment_status'
    ];

    public function businessPermit()
    {
        return $this->belongsTo(BusinessPermit::class);
    }
}
