<!doctype html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<title>Wanderlust Colombian Experience</title>
	<link media="all" type="text/css" rel="stylesheet" href="{{ URL::asset('css/bootstrap/bootstrap.min.css') }}">

	<script src="{{ URL::asset('js/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('js/bootstrap/bootstrap.min.js') }}"></script>
	<script type="text/javascript">URL_BASE = "{{ URL::to('/') }}/";</script>
	<script type="text/javascript" src="{{ URL::asset('js/app.controller.js') }}"></script>

</head>
<body class="{{$data['classbody']}}">

	@yield('content')


</body>
</html>