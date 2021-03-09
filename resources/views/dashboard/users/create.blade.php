@extends('dashboard.layout')
@section('content')
<form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
	@csrf
	<div class="row">
		<div class="col-md-6">
		  <div class="form-group">
		    <label for="InputName">Name</label>
		    <input type="text" name="name" class="form-control" placeholder="Enter Name">
		  </div>
	  	</div>
	  	<div class="col-md-6">
		  <div class="form-group">
		    <label for="InputUsername">Username</label>
		    <input type="text" name="username" class="form-control" placeholder="Enter Name">
		  </div>
	  	</div>
	  	<div class="col-md-6">
		  <div class="form-group">
		    <label for="InputEmail1">Email</label>
		    <input type="email" name="email" class="form-control" placeholder="Enter Name">
		  </div>
	  	</div>
	  	<div class="col-md-6">
		  <div class="form-group">
		    <label for="InputPassword">Password</label>
		    <input type="password" name="password" class="form-control" placeholder="******">
		  </div>			
	  	</div>
	  	<div class="col-md-6">
		  <div class="form-group">
		    <label for="InputPhone">Phone</label>
		    <input type="number" name="phone" class="form-control" placeholder="Enter Name">
		  </div>
	  	</div>
	  	<div class="col-md-6">
		  <div class="form-group">
		    <label for="InputCategory">Country</label>
		    <select name="country" class="form-control">
		    	<option value="0">Select</option>
		    	@if(!$country->isEmpty())
		    		@foreach($country as $list)
		    			<option value="{{ $list->id }}"> {{ $list->name }} </option>
		    		@endforeach
		    	@endif
		    </select>
		  </div>
	  	</div>
	  	<div class="col-md-6">
		  <div class="form-group">
		    <label for="InputCity">City</label>
		    <input type="text" name="city" class="form-control" placeholder="Enter City">
		  </div>
	  	</div>
	  	<div class="col-md-6">
		  <div class="form-group">
		    <label for="InputCategory">Role</label>
		    <select name="roles[]" class="form-control" multiple>
		    	@if(!$roles->isEmpty())
		    		@foreach($roles as $list)
		    			<option value="{{ $list->id }}"> {{ $list->name }} </option>
		    		@endforeach
		    	@endif
		    </select>
		  </div>
	  	</div>
	  	<div class="col-md-6">
		  <div class="form-group">
		    <label for="InputLogo">Profile</label>
		    <input type="file" name="photo" class="form-control">
		  </div>
	  	</div>
	  	<div class="col-md-6">
	  		<button type="submit" class="btn btn-primary">Submit</button>
	  	</div>
  	</div>
</form>
@endsection