<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    use HasFactory;

    public function users(){
        // hasOne, hasMany, belongsTo, belongsToMany
        return $this->belongsToMany(User::class,'profession_user','profession_id','user_id');
    }

}
