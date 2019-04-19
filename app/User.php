<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Role relationship
    public function role(){
        return $this->belongsTo('App\Role');
    }

    // Check if user has role
    // pass the variable role as a role name
    public function hasRole($role){
        return null !== $this->role()->where('name', $role)->first();
    }

    // one user can have multiple jobs posted
    // user is client here
    public function jobs(){
        return $this->hasMany('App\Job', 'user_id');
    }

    // one user can have multiple favourites
    public function favourites(){
        return $this->hasMany('App\Favourite', 'user_id');
    }

    // One user can have many threads
    public function threads(){
        return $this->belongsToMany('App\Thread');
    }

    // relationship for user-message relationship
    public function messages(){
        return $this->hasMany('App\Message', 'user_id');
    }
}
