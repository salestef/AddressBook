<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    public function country(){
        // hasOne, hasMany, belongsTo, belongsToMany
        return $this->hasMany(City::class);
    }
}
