@extends('layouts.post')
@section('title', 'Create post')

{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}
@section('content')
<form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
	@csrf
  <label for="fname">Title:</label><br>
  <input type="text" name="title" value=""><br>
  @error('title')
    <div class="alert alert-danger">{{ $message }}</div>
  @enderror
  <br>
  <label for="lname">Description:</label><br>
  <textarea name="content" >Laravel 6 Description fields</textarea><br><br>
  <input type="checkbox" name="check[]" value="Science"> Science
  <input type="checkbox" name="check[]" value="Computer"> Computer
  <input type="checkbox" name="check[]" value="Maths"> Maths
  <input type="checkbox" name="check[]" value="Biology"> Biology
  <br><br>
  <input type="file" name="photo">
  <br>
  @error('photo')
    <div class="alert alert-danger">{{ $message }}</div>
  @enderror
  <br>

  <input type="submit" value="Submit">
</form> 
@endsection