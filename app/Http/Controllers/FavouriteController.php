<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Favourite;
use Auth;

class FavouriteController extends Controller
{
	// Form button will be added to the jobs index view
    public function addFavourite(Request $request){
    	$this->validate($request, [
    		'job_id' => 'required|integer',
    	]);

    	// Find the currently authenticated user
    	$user = Auth::user();

    	$favourite = new Favourite();
    	$favourite->job_id = $request->input('job_id');

    	$user->favourites()->save($favourite);

    	return redirect('/jobs/'.$request->input('job_id'))->with('success', 'Favourite added');
    }

    public function getFavouritesWidget(){
    	$user = Auth::user();

    	// check if there is a logged in user
    	if (!is_null($user)) {
            // check if the logged in user is freelancer
    		if ($user->hasRole('Freelancer')) {
    			$favourites = array();
    			$favourites = $user->favourites;
    		}else{
    			// a client or an admin role that you may have created is logged in
    			// do not display a favourites widget
    			$favourites = false;
    		}
    	}else{
    		// if we don't find any user logged in at that time
    		$favourites = false;
    	}

    	return $favourites;
    }
}
