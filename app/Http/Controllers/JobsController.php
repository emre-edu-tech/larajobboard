<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use \Auth;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // first find the authenticated user
        $user = Auth::user();
        // look up the jobs and pass them to the index view
        // ask job model to return all the jobs it finds
        $jobs = $user->jobs->all();

        return view('jobs.index')->with('jobs', $jobs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate if the data is in the right format
        // validate the request by using a validation array
        $this->validate($request, [
            'title' => 'required|string',
            'description' => 'required|string',
            'budget' => 'required|numeric',
        ]);

        // when we have a validated input, create a job object
        $job = new Job();
        $job->title = $request->input('title');
        $job->description = $request->input('description');
        $job->budget = $request->input('budget');

        $user = Auth::user();

        // ask user to look at his jobs and save a new one
        // that will automatically save the job model and associate with the currently logged in
        $user->jobs()->save($job);  // just add the job to the database

        // display message to the user
        return redirect('/jobs')->with('success', 'Your new job was created');
    }

    /**
     * show the details of one individual job
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Get the job
        $job = Job::find($id);

        // added for threads
        $user = Auth::user();   // find the current logged in user

        switch($user->role->name){
            case 'Freelancer':
                $threads = array();
                $threads = $user->threads()->where('job_id', $job->id)->first();
                if(is_null($threads)){
                    $threads = false;
                } else{
                    $threads[] = $thread;
                }
                $UserType = 'Freelancer';
                          
                break;
            case 'Client':
                
                $UserType = 'Client';
                $threads = array();
                $threads = $job->threads;
            
                break;
            default:
                
                $UserType = false;
                $threads = array();
                
                break;
        }
        
        $data = [
            'job' => $job,
            'UserType' => $UserType,
            'threads' => $threads,
        ];

        // send the job object within the view
        return view('jobs.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // get the job which will be processed
        $job = Job::find($id);
        return view('jobs.edit')->with('job', $job);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // validate if the data is in the right format
        // validate the request by using a validation array
        $this->validate($request, [
            'title' => 'required|string',
            'description' => 'required|string',
            'budget' => 'required|numeric',
        ]);

        // when we have a validated input, create a job object
        $job = Job::find($id);

        $job->title = $request->input('title');
        $job->description = $request->input('description');
        $job->budget = $request->input('budget');

        $user = Auth::user();

        // ask user to look at his jobs and save a new one
        // that will automatically save the job model and associate with the currently logged in
        $user->jobs()->save($job);  // just add the job to the database

        // display message to the user
        return redirect('/jobs')->with('success', 'The job was updated');       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // find the requested job
        $job = Job::find($id);
        $job->delete();

        return redirect('/jobs')->with('success', 'The job was deleted');
    }
}
