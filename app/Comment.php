<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    public function post()
    {
        return $this->belongsTo(Post::class)->orderBy('created_at');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
