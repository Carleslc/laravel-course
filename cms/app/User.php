<?php

namespace App;

use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'is_active', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts() {
        return $this->hasMany('App\Post');
    }

    public function role() {
        return $this->belongsTo('App\Role');
    }

    public function isAdmin() {
        return $this->role ? $this->role->name == 'admin' : false;
    }

    public function avatar() {
        return Storage::url('avatars/' . $this->id);
    }

    public function hasAvatar() {
        return Storage::disk('public')->exists('avatars/' . $this->id);
    }

    public static function getDefaultAvatar() {
        return Storage::url('avatars/default.png');
    }
}
