<!doctype html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<title>Wanderlust Colombian Experience</title>
	<link media="all" type="text/css" rel="stylesheet" href="{{ URL::asset('css/bootstrap/bootstrap.min.css') }}">
	<style type="text/css">
		#wrapper{
			padding: 5px;
		}

		.error-label{
			width: 100%;
		    margin-top: .25rem;
		    font-size: 80%;
		    color: #dc3545;
		}
		#modal_loader{
			width: 100%;
		    height: 100%;
		    position: fixed;
		    z-index: 100000;
		    top: 0;
		    left: 0;
		    background: rgba(255,255,255,0.7);
		    display: none;
		}
		#modal_loader .spinner-border{
			position: absolute;
		    top: 50%;
		    left: 50%;
		    margin: -23px 0 0 -23px;
		}
	</style>

	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<script src="{{ URL::asset('js/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('js/bootstrap/bootstrap.min.js') }}"></script>
	<script type="text/javascript">URL_BASE = "{{ URL::to('/') }}/";</script>
	<script type="text/javascript" src="{{ URL::asset('js/app.controller.js') }}"></script>

</head>
<body class="{{$data['classbody']}}">

	@yield('content')

<div id="modal_loader">
  <div class="spinner-border" role="status">
    <span class="sr-only">Loading...</span>
  </div>
</div>
</body>
</html>