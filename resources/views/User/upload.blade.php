@extends('master')

@section('content')

<div class="container bg-white py-2 shadow">
	<h1 class="text-center"> Create New Content </h1> <hr>
	<div class="container my-3 col-10" id="status">
		<div class="progress">
		  	<div class="progress-bar bg-success progress-bar-striped" style="width:0%;" id="prog-status">
		  		0%
		  	</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-sm-12 p-2 mx-auto border bg-light">
				<h4 class="text-center my-3">Add Video Content</h4>
				<form id="videoform" data-url="{{route('user.upload.video')}}">
				<div class="row mt-4" id="video">
					<div class="col-5 mx-auto mb-3">
						Video Title: <input class="form-control" name="title">
					</div>
					<div class="col-5 mx-auto mb-3">
						Video file: <input type="file" class="form-control" name="VideoFile" style="padding:3px;">
					</div>
					<div class="col-5 mx-auto">
						Video Content Type: <select class="form-control" name="ctype" id="ContentType">
							<option value="select">Select</option>
						</select>
					</div>
					<div class="col-5 mx-auto">
						Qulaity: <select class="form-control" name="quality" id="Qulaity">
							<option value="select">Select</option>
						</select>
					</div>	
				</div>
				</form>
				<div class="row mt-4 mb-2">
					<div class="mx-auto">
						<button class="btn btn-primary d-inline-block" onclick="submit('videoform')">
							submit
						</button>
					</div>
				</div>		
			</div>

		</div>
	</div>

	@push('js')
    	<script type="text/javascript" src="/assets/js/user.upload.js"></script>
	@endpush

	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>

@endsection