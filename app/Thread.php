<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// import the soft delete functionality
use Illuminate\Database\Eloquent\SoftDeletes;

class Thread extends Model
{
    use SoftDeletes;

    // One thread can have many users related
    // One user can have many threads
    public function users(){
    	return $this->belongsToMany('App\User');	// Many to many relationships
    }

    public function messages(){
    	return $this->hasMany('App\Message', 'thread_id');	// One thread can have multiple messages
    }

    public function job(){
    	return $this->belongsTo('App\Job');		// One thread belongs to one job
    }
}
