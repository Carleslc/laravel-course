<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;

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

    // Accessor
    public function getHeaderAttribute($value) {
        return $value ? Post::IMAGES_PATH . $value : null;
    }

    public function hasHeader() {
        return $this->header != null;
    }

    // Query Scope
    public function scopeToday($query) {
        return $query->whereDate('created_at', Carbon::today())->get();
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
