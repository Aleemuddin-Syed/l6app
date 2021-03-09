@extends('layouts.post')
@section('title','Post list')
@section('content')
@component('components.message')
	<strong>Message!</strong> this is slot message
@endcomponent
<ul>
	{{-- @foreach($data as $list) --}}
		<li>{{ $data['title'] }}</li>
		<li>{{ $data['content'] }}</li>
	{{-- @endforeach --}}
	
</ul>
@endsection