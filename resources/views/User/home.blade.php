@extends('master')

@section('content')
	
	<h1 class="text-center"> Apps </h1> <hr>
	
	<div class="container">
		<div class="row">
			<div class="col-md-3 col-sm-4 p-2 mx-auto border bg-light"> 
				<div class="col-8 mx-auto">
					<img src="/assets/images/icons/media-player.png" class="img-fluid">
				</div>
				<div class="mt-3 text-center">
					<h5>Media Player</h5>
					<p>Play Audio And Video Online</p>
				</div>
			</div>
			<div class="col-md-3 col-sm-4 p-2 mx-auto border bg-light">
				<div class="col-8 mx-auto">
					<img src="/assets/images/icons/drive.png" class="img-fluid">
				</div>
				<div class="mt-3 text-center">
					<h5>Storage</h5>
					<p>Explore File & Folders</p>
				</div>
			</div>
			<div class="col-md-3 col-sm-4 p-2 mx-auto border bg-light"> 
				<div class="col-8 mx-auto">
					<img src="/assets/images/icons/document.png" class="img-fluid">
				</div>
				<div class="mt-3 text-center">
					<h5>Documents</h5>
					<p>View Your Documents</p>
				</div>
			</div>
		</div>
	</div>
	
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

@endsection