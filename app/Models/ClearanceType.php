<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClearanceType extends Model
{
    protected $table = 'clearance_types';
    protected $fillable = ['clearance_name', 'description', 'validity', 'fee'];

    public function clearances() {
        return $this->hasMany(BarangayCertificate::class);
    }
}
