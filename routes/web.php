<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::any('test-0',function(){
	/*echo '<form action="/test" method="post" enctype="multipart/form-data">
		<input type="hidden" name="_token" value="'.csrf_token().'">
	    Select image to upload:
	    <input type="file" name="file" id="fileToUpload">
	    <input type="submit" value="Upload Image" name="submit">
	</form>';*/
	return view('User.test');
});

Route::any('test','User\Test@test');

Route::get('/', function(){
    return view('User.home');
})->name('index');

Route::group(['prefix'=>'User'],function(){

	Route::get('/','User\Home@dashboard')->name('user.dashboard');

	Route::get('/upload',function(){return view('User.upload');})->name('user.upload');

	Route::post('/uploadvideo','User\Home@VideoUpload')->name('user.upload.video');

	Route::post('/uploadaudio','User\Home@AudioUpload')->name('user.upload.audio');

});

Route::group(['prefix'=>'Apps'],function(){

	Route::group(['prefix'=>'Video-Player'],function(){

		Route::get('/',function(){
			return view('User.videoplayer');
		})->name('app.vp.home');

		Route::post('fetch','Apps\VideoPlayer\Home@fetch')->name('app.vp.fetch');

		Route::post('fetchallmedia','Apps\VideoPlayer\Home@fetch_all_meta')->name('app.vp.fetchallmedia');

	});

	Route::group(['prefix'=>'Music-Player'],function(){

		Route::get('/',function(){
			return view('User.musicplayer');
		})->name('app.mp.home');

		Route::post('fetch','Apps\MusicPlayer\Home@fetch')->name('app.mp.fetch');

		Route::post('fetchall','Apps\MusicPlayer\Home@fetch_all_meta')->name('app.mp.fetchall');

	});

		

});


