@extends('dashboard.layout')
@section('content')
<form method="POST" action="{{ route('roles.store') }}">
	@csrf
	<div class="row">
		<div class="col-md-6">
		  <div class="form-group">
		    <label for="InputEmail1">Name</label>
		    <input type="text" name="name" class="form-control" placeholder="Enter Name">
		  </div>
			<button type="submit" class="btn btn-primary">Submit</button>
	  	</div>
  	</div>
</form>
@endsection