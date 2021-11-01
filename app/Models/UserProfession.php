<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfession extends Model
{
    use HasFactory;

    public function user(){
        // hasOne, hasMany, belongsTo, belongsToMany
        return $this->hasOne(Profession::class);
    }

    public function profession(){
        // hasOne, hasMany, belongsTo, belongsToMany
        return $this->hasOne(Profession::class);
    }
}
