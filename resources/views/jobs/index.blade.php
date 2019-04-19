@extends('layouts.app')

@section('content')
	<h2>Jobs</h2>
	<hr>
	@if(count($jobs) > 0)
		<table cellpadding="5px" cellspacing="5px" style="border: 1px solid #000">
			<tr>
				<th>Job Title</th>
				<th>Job Description</th>
				<th>Job Budget</th>
				<th>Edit jobs</th>
				<th>Job Details</th>
			</tr>
		@foreach($jobs as $job)
			<tr>
				<td>{{ $job->title }}</td>
				<td>{{ $job->description }}</td>
				<td>$ {{ $job->budget }}</td>
				<td><a href="/jobs/{{$job->id}}/edit">Edit</a></td>
				<td><a href="/jobs/{{$job->id}}">Detail</a></td>
			</tr>
		@endforeach
		</table>
	@else
		<p>There is no job posted by this client.</p>
	@endif
@endsection