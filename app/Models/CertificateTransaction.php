<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CertificateTransaction extends Model
{
    protected $fillable = [
        'certificate_id',
        'amount_paid',
        'payment_date',
        'payment_status',
    ];

    public function certificate()
    {
        return $this->belongsTo(BarangayCertificate::class);
    }
}
