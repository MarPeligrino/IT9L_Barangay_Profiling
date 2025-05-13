<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangayEmployee extends Model
{
    protected $table = 'barangay_employees';
    protected $fillable = ['position_id', 'first_name', 'middle_name', 'last_name', 'contact_number' , 'start_date'];

    public function position() {
        return $this->belongsTo(BarangayPosition::class, 'position_id');
    }

    public function business() {
        return $this->hasMany(Business::class);

    }

}
