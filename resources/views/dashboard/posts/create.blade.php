@extends('dashboard.layout')
@section('content')
<form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
	@csrf
	<div class="row">
		<div class="col-md-6">
		  <div class="form-group">
		    <label for="InputName">Title</label>
		    <input type="text" name="title" class="form-control" placeholder="Enter Name">
		  </div>
	  	</div>
	  	<div class="col-md-6">
		  <div class="form-group">
		    <label for="InputCategory">Category</label>
		    <select name="categories[]" class="form-control" multiple>
		    	@if(!$category->isEmpty())
		    		@foreach($category as $list)
		    			<option value="{{ $list->id }}"> {{ $list->title }} </option>
		    		@endforeach
		    	@endif
		    </select>
		  </div>
	  	</div>
	  	<div class="col-md-6">
		  <div class="form-group">
		    <label for="InputText">Contents</label>
		    <textarea name="content" class="form-control" placeholder="Enter Content"></textarea>
		  </div>
	  	</div>
	  	<div class="col-md-6">
		  <div class="form-group">
		    <label for="InputLogo">Thumbnail</label>
		    <input type="file" name="thumbnail" class="form-control">
		  </div>
	  	</div>
	  	<div class="col-md-6">
	  		<button type="submit" class="btn btn-primary">Submit</button>
	  	</div>
  	</div>
</form>
@endsection