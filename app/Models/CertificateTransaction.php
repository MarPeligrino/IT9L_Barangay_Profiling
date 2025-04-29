<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CertificateTransaction extends Model
{
    protected $fillable = [
        'CertificateID',
        'AmountPaid',
        'PaymentDate',
        'PaymentStatus',
    ];

    public function barangayCertificate()
    {
        return $this->belongsTo(BarangayCertificate::class);
    }
}
