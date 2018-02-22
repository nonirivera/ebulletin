<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile_message extends Model
{
    //
    public function user(){
        return $this->belongsTo(User::class);
    }
}
