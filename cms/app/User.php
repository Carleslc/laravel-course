<?php

namespace App;

use App\Helpers\StorageHelper;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Str;

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

    public function getAvatarAttribute() {
        return StorageHelper::getImage('avatars', $this->id, $this->gravatar);
    }

    public function getGravatarAttribute() {
        $hash = md5(Str::lower($this->attributes['email']));
        return "https://www.gravatar.com/avatar/$hash?s=64&r=pg&d=mysteryperson";
    }
}
