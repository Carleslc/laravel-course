<?php

namespace App;

use App\Helpers\StorageHelper;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Sluggable;

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

    public function comments() {
        return $this->hasMany('App\Comment');
    }

    public function getHeaderAttribute() {
        return StorageHelper::getImage('headers', $this->id);
    }

    public function sluggable() {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
