<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    protected $fillable = [
        'comment_id',
        'author_id',
        'content',
        'is_active'
    ];

    public function author() {
        return $this->belongsTo('App\User', 'author_id');
    }

    public function comment() {
        return $this->belongsTo('App\Comment');
    }
}
