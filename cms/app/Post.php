<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'user_id',
        'category_id'
    ];

    public function author() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function category() {
        return $this->belongsTo('App\Category', 'category_id');
    }
}
