<!-- $errors variable is provided by laravel for  -->
<!-- system errors -->
@if(count($errors))
	@foreach($errors->all() as $error)
		<div class="alert alert-danger">
			{{ $error }}
		</div>
	@endforeach
@endif

<!-- custom messages -->
@if(session('success'))
	<div class="alert alert-success">
		{{ session('success') }}
	</div>
@endif

<!-- forexample for a confirm before deleting an item -->
@if(session('error'))
	<div class="alert alert-success">
		{{ session('error') }}
	</div>
@endif
