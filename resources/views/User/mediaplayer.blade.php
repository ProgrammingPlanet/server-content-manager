@extends('master')

@section('content')

	@push('css')
		<link rel="stylesheet" href="/assets/lib/css/plyr.css">
	@endpush

	<div class="row">
		<div class="col-lg-11 mx-auto border bg-white shadow py-1">
			
		
			<div class="row bg-white">

				<div class="col-lg-8 col-md-8 p-2 ">
					<div class="col-12 px-0 ">
						<video poster="/content/default.jpg" id="player" controls crossorigin playsinline></video>
					</div>
					<div class="col-12 mt-2 py-2 ">
						<h5 class="" id="playertitle">
							"Musalman" : A Poem by Hindi Poet Devi Prasad Mishra | The Lallantop | Ek Kavita Roz
						</h5>
						<div>
							170,50 views • jan 11 2020
						</div>
					</div>
				</div>
				<div class="col-lg-4 px-1 ">
					<div class="container my-1">
						<div class="row my-2 border">
							<div class="col-3 p-2">
								<img src="/content/video-icon.png" class="img-thumbnail">
							</div>
							<div class="col-9 mt-2">
								<div class="text-truncate">
									<b>Video Title Here </b><br>
									<small>Hacker World Here</small>
								</div>
								<small>20-07-2013, 20:58</small><br>
								<small>Duration - 2:58</small>
							</div>
						</div>
						<div class="row my-2 border">
							<div class="col-3 p-2">
								<img src="/content/music-icon.png" class="img-thumbnail">
							</div>
							<div class="col-9 mt-2">
								<div class="text-truncate">
									<b>Audio Title Here </b><br>
									<small>Hacker World Here</small>
								</div>
								<small>20-07-2013, 20:58</small><br>
								<small>Duration - 2:58</small>
							</div>
						</div>	
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
