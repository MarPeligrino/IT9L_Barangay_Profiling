<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business_Type extends Model
{
    protected $fillable = ['name', 'description'];

    public function businesses() {
        return $this->hasMany(Business::class);
    }
}
