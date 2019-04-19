@extends('layouts.app')

@section('content')
	<h2>All Jobs</h2>
	<hr>
	@if(count($jobs) > 0)
		<table cellpadding="5px" cellspacing="5px" style="border: 1px solid #000">
			<tr>
				<th>Job Title</th>
				<th>Job Description</th>
				<th>Job Budget</th>
			</tr>
		@foreach($jobs as $job)
			<tr>
				<td><a href="/jobs/{{ $job->id }}">{{ $job->title }}</a></td>
				<td>{{ $job->description }}</td>
				<td>$ {{ $job->budget }}</td>
			</tr>
		@endforeach
		</table>
	@else
		<p>There is no job on our job board yet!</p>
	@endif
@endsection