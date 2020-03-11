@extends('master')

@section('content')

	@push('css')
		<link rel="stylesheet" href="/assets/lib/css/plyr.css">
	@endpush

	<div class="row">
		<div class="col-lg-11 mx-auto border bg-white shadow py-1">
			
		
			<div class="row bg-white">

				<div class="col-lg-8 col-md-8 p-2">
					<div class="col-12 px-0 embed-responsive embed-responsive-16by9">
						<div class="embed-responsive-item">
							<video id="player" controls crossorigin playsinline></video>
						</div>
					</div>
					<div class="col-12 mt-2 py-2 ">
						<h5 class="" id="mediatitle">
							{{-- media title --}}
						</h5>
						<div>
							<span id="viewcount">{{-- views count --}}</span> views • 
							<span id="uploadtime">{{-- time & date --}}</span> (IST) 
						</div>
					</div>
				</div>
				<div class="col-lg-4 px-1 ">
					<div class="container my-1" id="allmedias">
						{{-- <div class="row my-2 border">
							<div class="col-3 p-2">
								<img src="/assets/images/icons/video.png" class="img-thumbnail">
							</div>
							<div class="col-9 mt-2">
								<div class="text-truncate">
									<b>Video Title Here </b><br>
									<small>Hacker World</small>
								</div>
								<small>
									5 days ago • 560 MB
								</small>
							</div>
						</div> --}}
					</div>
				</div>	

			</div>
		</div>
	</div>
	

	@push('js')
		<script type="text/javascript" src="/assets/lib/js/plyr.js"></script>
    	<script type="text/javascript" src="/assets/js/custom.plyr.js"></script>
	@endpush
	
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

@endsection
