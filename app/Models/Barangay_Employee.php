<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barangay_Employee extends Model
{
    protected $fillable = ['position_id', 'first_name', 'middle_name', 'last_name', 'contact_number'];

    public function position() {
        return $this->belongsTo(Barangay_Position::class);
    }
}
