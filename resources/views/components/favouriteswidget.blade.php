@if($favouritesWidget != false)
	<h2>My Favourites</h2>
	@if(count($favouritesWidget) > 0)
		<ul>
			@foreach($favouritesWidget as $favourite)
				<li><a href="/jobs/{{$favourite->job->id}}">{{$favourite->job->title}}</a></li>
			@endforeach
		</ul>
	@else
		<p>You have not saved any favourites</p>
	@endif
@endif