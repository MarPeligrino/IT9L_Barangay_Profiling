<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barangay_Position extends Model
{
    protected $fillable = ['position_name', 'description'];

    public function employees() {
        return $this->hasMany(Barangay_Employee::class);
    }
}
