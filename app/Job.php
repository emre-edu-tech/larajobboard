<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
	use SoftDeletes;

	// user relationship
    public function user(){
    	return $this->belongsTo('App\User');
    }

    // favourite relationship
    public function favourites(){
    	return $this->hasMany('App\Favourite', 'job_id');
    }

    // one job can have many threads
    public function Threads(){
	    return $this->hasMany('App\Thread', 'job_id');
    }
}
