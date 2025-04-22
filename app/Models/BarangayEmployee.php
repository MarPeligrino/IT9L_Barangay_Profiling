<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangayEmployee extends Model
{
    protected $table = 'barangay_employees';
    protected $fillable = ['position_id', 'first_name', 'middle_name', 'last_name', 'contact_number'];

    public function position() {
        return $this->belongsTo(BarangayPosition::class);
    }
}
