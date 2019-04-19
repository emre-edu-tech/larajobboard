<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use all related models
use App\Thread;
use App\Message;
use Auth;

class ThreadController extends Controller
{
    public function createThread(Request $request){
    	// validate the request
    	$this->validate($request, [
			'job_id' => 'required|integer',
    	]);

    	// once the validation done, create the new thread
    	$thread = new Thread();
    	$thread->job_id = $request->input('job_id');

    	// save the thread
    	$thread->save();

    	// only a freelancer can create a thread about a job
    	$freelancer = Auth::user();

    	// client is the owner of the job posted
    	$client = $thread->job->user;

    	// save the freelancer user as the starter of the thread
    	$thread->users()->save($freelancer);

    	// save the client user as the owner of the job that a thread has been just created for
    	$thread->users()->save($client);

    	// once we saved the thread and related info to the database
    	return redirect('/threads/'.$thread->id)->with('success', 'A thread has been posted');
    }

    // After the thread has been created, messages must have been sent on this thread
    // thread_id will come from the post request when a thread is created
    public function createMessage(Request $request, $thread_id){
    	$this->validate($request, [
    		'message' => 'required|string',
    	]);

    	// after validation create a new message
    	$message = new Message();
    	$message->message = $request->input('message');
    	$message->thread_id = $thread_id;
    	$user = Auth::user();
    	$user->messages()->save($message);

    	return redirect('/threads/'.$thread_id)->with('success', 'Your message has been posted');
    }

    // show the created thread
    public function showThread($id){
    	// find the thread
    	$thread = Thread::find($id);
    	return view('threads.show')->with('thread', $thread);
    }
}
