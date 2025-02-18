<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class course extends Model
{

    protected $fillable = ['title'];

   public function student(){
    return $this->belongsToMany(student::class);
   }
}
