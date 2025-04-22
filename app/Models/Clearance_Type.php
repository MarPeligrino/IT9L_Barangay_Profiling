<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clearance_Type extends Model
{
    protected $fillable = ['clearance_name', 'description', 'validity', 'fee'];

    public function clearances() {
        return $this->hasMany(Barangay_Clearance::class);
    }
}
