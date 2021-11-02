<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function users(){
        // hasOne, hasMany, belongsTo, belongsToMany
        return $this->hasMany(User::class);
    }

    public function city(){
        // hasOne, hasMany, belongsTo, belongsToMany
        return $this->belongsTo(City::class);
    }
}
