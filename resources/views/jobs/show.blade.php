@extends('layouts.app')

@section('content')
	<h2>Job Details</h2>
	{{ Form::open(['action' => 'FavouriteController@addFavourite', 'method' => 'POST']) }}
		{{Form::hidden('job_id', $job->id)}}
		{{ Form::submit('Add to Favourites', ['class' => 'btn btn-primary']) }}
	{{ Form::close() }}
	<hr>
	<h4>{{ $job->title }}</h4>
	<p>Description: {{ $job->description }}</p>
	<p>Budget: $ {{ $job->budget }}</p>

	<hr>

	<h3>Messages</h3>
	@if($UserType == 'Freelancer')
		@if($threads != false)
			@foreach($threads as $thread)
				<a href="/threads/{{$thread->id}}" class="btn btn-primary">View Conversation</a>
			@endforeach
		@else
			{{ Form::open(['action' => 'ThreadController@createThread', 'method' => 'POST']) }}
				{{ Form::hidden('job_id', $job->id) }}
				{{ Form::submit('Send Message', ['class' => 'btn btn-primary']) }}
			{{ Form::close() }}
		@endif
	@endif

	@if($UserType == 'Client')
		@if(count($threads) > 0)
			@foreach($threads as $thread)
				<h4>Participants</h4>
				<ul>
					@if(count($thread->users) > 0)
						@foreach($thread->users as $threadUser)
							<li>{{ $threadUser->name }}</li>
						@endforeach
					@endif
				</ul>
				<a href="/threads/{{$thread->id}}" class="btn btn-primary">View Conversation</a>
				<hr>
			@endforeach
		@else
			<p>No messages found</p>
		@endif
	@endif
@endsection

