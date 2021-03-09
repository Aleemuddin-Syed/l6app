<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
	<meta charset="utf-8">
	<meta name="csrf_token" content="{{ csrf_token() }}">
</head>
<body>
	<div class="container">
		<h2> @yield('title') </h2>
		@yield('content')
	</div>
	<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
</body>
</html>