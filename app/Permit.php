<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permit extends Model
{
    protected $guarded = [];

    public function permit_name(){
        return $this->hasOne(User::class,'id_user','id_user');
    }
}
