<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Family_Role extends Model
{
    protected $fillable = ['role', 'relationship'];

    public function residents() {
        return $this->hasMany(Resident::class);
    }
}
