@extends('layouts.app')

@section('content')
	<h2>Create a job</h2>
	
	{{ Form::open(['action' => 'JobsController@store']) }}

	<div class="form-group">
		<!-- title -> for, value -->
		{{Form::label('title', 'Job Title')}}
		<!-- name and id, value, class, placeholder -->
		{{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Enter Job Title'])}}
	</div>
	
	<div class="form-group">
		{{Form::label('description', 'Job Description')}}
		{{Form::textArea('description', '', ['class' => 'form-control', 'placeholder' => 'Enter Job Description'])}}
	</div>

	<div class="form-group">
		<!-- title -> name and id classic form elements -->
		{{Form::label('budget', 'Job Budget')}}
		<!-- step => any  permits user to enter any numerical value -->
		{{Form::number('budget', '', ['class' => 'form-control', 'placeholder' => 'Enter Job Budget - $', 'step' => 'any'])}}
	</div>

	{{ Form::submit('Post Job', ['class' => 'btn btn-primary']) }}
	{{ Form::close() }}
@endsection