@extends('master')

@section('content')

	@push('css')
		<link rel="stylesheet" href="/assets/lib/css/fontawesome.pro.5.all.min.css">
		<link rel="stylesheet" href="/assets/lib/css/jquery.dataTables.min.css">
		<link rel="stylesheet" href="/assets/lib/css/dataTables.bootstrap4.min.css">
		<link rel="stylesheet" href="/assets/css/custom.musicplayer.css">
	@endpush

	<div class="row">
		<div class="col-lg-11 mx-auto border bg-white shadow py-1">

			<div class="row bg-white">

				<div class="col-lg-8 col-md-8 mx-auto my-2 border" id="player"> 
					<div class="row mx-auto embed-responsive embed-responsive-21by9">
						<div class="embed-responsive-item px-0">
							<div class="row h-100">
							    <div class="col-11 m-auto px-0 text-center fo-res-md" id="lyrics">
							        <h4 id="curline"> ♪ </h4>
							    </div>
							</div>
						</div>
					</div>

					<audio id="audio" class="d-none">
						<source src="" type="" id="audiosrc1">
						<track src="" kind="subtitles" srclang="" label="" id="captsrc1" default>
					</audio>

					<div class="row border-top" id="controls">
						<div class="col-12 py-2 border-bottom">
							<div class="row">
								<div class="col-2 px-0 text-center" id="curtime">
									00:00:00
								</div>
								<div class="col-8 my-auto px-0">
									<div class="progress pointer" style="height:8px" id="prgcont">
									  <div class="progress-bar" id="prgbar"></div>
									  <!-- <div class="progress-bar bg-info" id="buff"></div> -->
									</div>
								</div>
								<div class="col-2 px-0 text-center" id="tottime">
									00:00:00
								</div>
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-2 mx-auto">
							<div class="row h-100">
								<div class="col-12 text-center my-auto px-0">
									<i class="fas fa-repeat-1 pointer"></i>
								</div>
							</div>
						</div>
						<div class="col-lg-8 col-md-8 col-sm-8 col-8 mx-auto">
							<div class="row h-100 p-1">
								<div class="m-auto">
									<div class="input-group">
									  <div class="input-group-prepend">
									    <button class="btn btn-outline-info btn-sm px-3 rounded-left">
									    	<i class="fas fa-fast-backward"></i>
									    </button>
									    <button class="btn btn-outline-info btn-sm px-3" onclick="controls('bwd')">
									    	<i class="fas fa-backward"></i>
									    </button>
									    <button class="btn btn-outline-info btn-sm px-3" id="ppbtn" onclick="controls('play-pause')">
									    	<i class="fas fa-play"></i>
									    </button>
									    <button class="btn btn-outline-info btn-sm px-3" onclick="controls('fwd')">
									    	<i class="fas fa-forward"></i>
									    </button>
									    <button class="btn btn-outline-info btn-sm px-3 rounded-right">
									    	<i class="fas fo-res-sm fa-fast-forward"></i> 
									    </button>
									  </div>
									</div>
								</div>
								
							</div>
						</div>
						<div class="col-lg-2 col-md-2 col-sm-2 col-2 mx-auto">
							<div class="row h-100">
								<div class="col-3 text-center my-auto px-0">
									<i class="fas fa-volume-up"></i>
								</div>
								<div class="col-9 px-1 py-0">
									<input type="range" class="custom-range my-2" id="vol" onchange="changevolume(this.value/100)">
								</div>
							</div>
						</div>
					</div>

				</div>
				
				<div class="col-lg-8 col-md-8 mx-auto my-2 border py-2 px-1"> 
					
					<table class="table table-hover table-bordered table-sm" id="songlist" width="100%">
						<thead class="text-center">
							<tr>
								<th>Title</th>
								<th>Duration</th>
								<th>Upload Time</th>
								<th>Options</th>
							</tr>
						</thead>
						<tbody class="text-center" id="playlist">
							
						</tbody>
					</table>

				</div>
			</div>
			<br><br><br><br><br><br><br><br>
		</div>
	</div>
	

	@push('js')
		<script type="text/javascript" src="/assets/lib/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="/assets/lib/js/dataTables.bootstrap4.min.js"></script>
		<script type="text/javascript" src="/assets/js/custom.musicplayer.js"></script>
	@endpush

@endsection
