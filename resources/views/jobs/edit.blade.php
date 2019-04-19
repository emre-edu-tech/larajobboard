@extends('layouts.app')

@section('content')
	<h2>Edit a job</h2>
	
	{{ Form::open(['action' => ['JobsController@update', $job->id], 'method' => 'POST']) }}

	<div class="form-group">
		<!-- title -> for, value -->
		{{Form::label('title', 'Job Title')}}
		<!-- name and id, value, class, placeholder -->
		{{Form::text('title', $job->title, ['class' => 'form-control'])}}
	</div>
	
	<div class="form-group">
		{{Form::label('description', 'Job Description')}}
		{{Form::textArea('description', $job->description, ['class' => 'form-control'])}}
	</div>

	<div class="form-group">
		<!-- title -> name and id classic form elements -->
		{{Form::label('budget', 'Job Budget ($)')}}
		<!-- step => any  permits user to enter any numerical value -->
		{{Form::number('budget', $job->budget, ['class' => 'form-control', 'step' => 'any'])}}
	</div>
	
	{{ Form::hidden('_method', 'PUT') }}
	{{ Form::submit('Update Job', ['class' => 'btn btn-primary']) }}
	{{ Form::close() }}

	<!-- Add delete button -->
	{{ Form::open(['action' => ['JobsController@destroy', $job->id], 'method' => 'POST']) }}
	{{ Form::submit('Delete Job', ['class' => 'btn btn-danger']) }}
	{{ Form::hidden('_method', 'DELETE') }}
	{{ Form::close() }}
@endsection