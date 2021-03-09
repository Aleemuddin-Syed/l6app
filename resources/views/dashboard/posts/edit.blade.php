@extends('dashboard.layout')
@section('content')
<form method="POST" action="{{ route('posts.update',$posts->id) }}" enctype="multipart/form-data">
	@csrf
	@method("PUT")
	<div class="row">
		<div class="col-md-6">
		  <div class="form-group">
		    <label for="InputName">Title</label>
		    <input type="text" name="title" class="form-control" value="{{ $posts->title }}" placeholder="Enter Name">
		  </div>
	  	</div>
	  	<div class="col-md-6">
		  <div class="form-group">
		    <label for="InputCategory">Category</label>
		    <select name="categories[]" class="form-control" multiple>
		    	@if(!$categories->isEmpty())
		    		@foreach($categories as $list)
		    			<option value="{{ $list->id }}" 
		    				@if(in_array($list->id,$posts->categories->pluck('id')->toArray())) {{ 'selected' }} @endif > {{ $list->title }} </option>
		    		@endforeach
		    	@endif
		    </select>
		  </div>
	  	</div>
	  	<div class="col-md-6">
		  <div class="form-group">
		    <label for="InputText">Contents</label>
		    <textarea name="content" class="form-control" placeholder="Enter Content">{{ $posts->content }}</textarea>
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