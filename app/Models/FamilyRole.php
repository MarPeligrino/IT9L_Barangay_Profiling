<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FamilyRole extends Model
{
    protected $table = 'family_roles';
    protected $fillable = ['role', 'relationship'];

    public function residents() {
        return $this->hasMany(Resident::class);
    }
}
