@extends('layouts.app')

@section('content')
	
	<h2>{{$thread->job->title}} - Messages</h2>
	<p>{{$thread->job->description}}</p>
	<hr>
	@if(count($thread->messages) > 0)
		<table cellpadding="5" cellspacing="5">
			<tr>
				<th>User</th>
				<th>Message</th>
			</tr>
			@foreach($thread->messages as $threadMessage)
				<tr>
					<td>{{$threadMessage->user->name}}</td>
					<td>{{$threadMessage->message}}</td>
				</tr>
			@endforeach
		</table>
	@else
		<p>No messages found</p>
	@endif
	<hr>
	{{Form::open(['action' => ['ThreadController@createMessage', $thread->id], 'method' => 'POST'])}}
		<div class="form-group">
			{{Form::label('message', 'Create a Message')}}
			{{Form::textArea('message', '', ['class' => 'form-control', 'placeholder' => 'Message'])}}
		</div>
		{{Form::submit('Send Message', ['class' => 'btn btn-primary'])}}
	{{Form::close()}}
@endsection