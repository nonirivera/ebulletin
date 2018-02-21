<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function threads()
    {
        return $this->belongsTo('App\Thread','thread_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class); # alternative for full class path
    }
}
