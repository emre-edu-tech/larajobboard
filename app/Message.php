<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// import the soft delete functionality
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
	use SoftDeletes;
	
    // Message-thread relationship
    public function thread(){
    	return $this->belongsTo('App\Thread');
    }

    // message-user relationship
    public function user(){
    	return $this->belongsTo('App\User');
    } 
}
