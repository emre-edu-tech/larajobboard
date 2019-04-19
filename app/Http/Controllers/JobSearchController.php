<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;

class JobSearchController extends Controller
{
    public function index(){

    	// request all jobs except softdeleted ones
    	$jobs = Job::all();

    	return view('jobsearch.index')->with('jobs', $jobs);
    }
}
