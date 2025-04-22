<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Household extends Model
{
    protected $fillable = ['purok', 'address'];

    public function residents() {
        return $this->hasMany(Resident::class);
    }
}
