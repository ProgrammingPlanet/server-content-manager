<!DOCTYPE html>
<html>
<head>
	<title>HomePage</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="/assets/lib/css/bootstrap.min.css">

	<style>
		.no-ul:hover{
			text-decoration: none;
			color: default;
		}
	</style>

	@stack('css')
	
	<script src="/assets/lib/js/jquery.min.js"></script>
	<script src="/assets/lib/js/popper.min.js"></script>
	<script src="/assets/lib/js/bootstrap.min.js"></script>

</head>
<body class="bg-light">
	@csrf

	<div class="container-fluid"> <!-- container-fluid -->
		
		@include('header')
		
		<br><br><br>

		@yield('content')

	</div>
	
	<br><br>
	
	@stack('js')
</body>
</html>