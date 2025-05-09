<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CertificateType extends Model
{
    protected $table = 'certificate_types';
    protected $fillable = ['certificate_name', 'description', 'validity', 'fee'];

    public function certificates() {
        return $this->hasMany(BarangayCertificate::class);
    }
}
