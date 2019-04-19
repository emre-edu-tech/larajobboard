<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function getUserMenu(){
    	$menu = array();	// created an empty menu for menu items

    	// check what kind of a user he/she is
    	// user will be an authenticated user
    	$user = Auth::user();

    	if (!is_null($user)) {
    		// Everyone has right to enter this dashboard
    		$menu['/home'] = 'Dashboard';

    		if ($user->hasRole('Client')) {
                $menu['/jobs'] = 'My Jobs';
    			// if the user is Client build menu according to it
    			$menu['/jobs/create'] = 'Post a new job';
    		}

    		if ($user->hasRole('Freelancer')) {
    			// if the user is Freelancer build menu according to it
    			$menu['/jobsearch'] = 'Find a job';
    		}
    	}

    	return $menu;
    }
}
