<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    protected $guarded = [];

    public function presence_name(){
        return $this->hasOne(User::class,'id_user','id_user');
    }
}
