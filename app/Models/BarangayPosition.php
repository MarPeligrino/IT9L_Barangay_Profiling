<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangayPosition extends Model
{
    protected $table = 'barangay_positions';
    protected $fillable = ['position_name', 'description'];

    public function employees() {
        return $this->hasMany(BarangayEmployee::class);
    }
}
