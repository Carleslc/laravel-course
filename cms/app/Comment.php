<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'post_id',
        'author_id',
        'content',
        'is_active'
    ];

    public function author() {
        return $this->belongsTo('App\User', 'author_id');
    }

    public function post() {
        return $this->belongsTo('App\Post');
    }

    public function replies() {
        return $this->hasMany('App\CommentReply');
    }
}
