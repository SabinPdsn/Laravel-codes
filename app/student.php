<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class student extends Model
{

    protected $fillable = ['name'];

    public function courses(){

        return $this->belongsToMany(course::class);
    }
}
