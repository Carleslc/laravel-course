<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    const IMAGES_PATH = '/images/';

    // protected $table = 'posts';
    // protected $primaryKey = 'id';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title',
        'content',
        'header',
        'user_id'
    ];

    public function getHeaderAttribute($value) {
        return $value ? Post::IMAGES_PATH . $value : null;
    }

    public function hasHeader() {
        return $this->header != null;
    }

    // Query Scope
    public function scopeLatest($query) {
        return $query->orderBy('created_at', 'desc')->get();
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
