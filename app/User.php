<?php

namespace LaraACL;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Kodeine\Acl\Traits\HasRole;
use Kodeine\Acl\Traits\HasPermission;


class User extends Authenticatable
{
    use Notifiable,HasRole;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function permissions()
    {
       // $model = config('acl.permission', 'Kodeine\Acl\Models\Eloquent\Permission');
        return $this->belongsToMany("Kodeine\Acl\Models\Eloquent\Permission")->withTimestamps();
    }


    public function roles()
    {
        return $this->belongsToMany("Kodeine\Acl\Models\Eloquent\Role")->withTimestamps();
    }
}
