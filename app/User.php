<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
    	return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function hasAccess(array $permissions)
    {
        foreach($this->roles as $role){
            if($role->hasAccess($permissions)) return true;
        }
        return false;
    }
}
