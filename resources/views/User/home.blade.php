@extends('master')

@section('content')

<div class="container bg-white py-2 shadow">
	<h1 class="text-center"> Apps </h1> <hr>
	
	<div class="container">
		<div class="row">
			<div class="col-md-3 col-sm-4 col-10 p-2 mx-auto">
				<a href="{{route('app.mp.home')}}" class="no-ul"> 
					<div class="card">
					  	<div class="card-header text-center">
					  		<img src="/assets/images/icons/audio.png" class="img-fluid mx-auto">
					  	</div>
					  	<div class="card-body text-center">
					  		<h5>Music Player</h5>
							<small>Play Music Online</small>
					  	</div>
					</div>
				</a>
			</div>
			<div class="col-md-3 col-sm-4 col-10 p-2 mx-auto">
				<a href="{{route('app.vp.home')}}" class="no-ul"> 
					<div class="card">
					  	<div class="card-header text-center">
					  		<img src="/assets/images/icons/video.png" class="img-fluid">
					  	</div>
					  	<div class="card-body text-center">
					  		<h5>Video Player</h5>
							<small>Play Videos Online</small>
					  	</div>
					</div>
				</a>
			</div>
			<div class="col-md-3 col-sm-4 col-10 p-2 mx-auto">
				<a href="{{route('index')}}" class="no-ul"> 
					<div class="card">
					  	<div class="card-header text-center">
					  		<img src="/assets/images/icons/drive.png" class="img-fluid">
					  	</div>
					  	<div class="card-body text-center">
					  		<h5>Storage</h5>
							<small>Explore File & Folders</small>
					  	</div>
					</div>
				</a>
			</div>
			<div class="col-md-3 col-sm-4 col-10 p-2 mx-auto">
				<a href="{{route('index')}}" class="no-ul"> 
					<div class="card">
					  	<div class="card-header text-center">
					  		<img src="/assets/images/icons/document.png" class="img-fluid">
					  	</div>
					  	<div class="card-body text-center">
					  		<h5>Documents</h5>
							<small>View Your Documents</small>
					  	</div>
					</div>
				</a>
			</div>
		</div>
	</div>
	
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>

@endsection