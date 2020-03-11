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

Route::get('test', function(){
   echo public_path('content/');
});

Route::get('/', function(){
    return view('User.home');
})->name('index');

Route::group(['prefix'=>'User'],function(){

	Route::get('/','User\Home@dashboard')->name('user.dashboard');

	Route::get('/upload',function(){return view('User.upload');})->name('user.upload');

	Route::post('/uploadvideo','User\Home@VideoUpload')->name('user.upload.video');

});

Route::group(['prefix'=>'Apps'],function(){

	Route::group(['prefix'=>'Video-Player'],function(){

		Route::get('/',function(){
			return view('User.mediaplayer');
		})->name('app.mp.home');

		Route::post('fetch','Apps\VideoPlayer\Home@fetch')->name('app.vp.fetch');

		Route::post('fetchallmedia','Apps\VideoPlayer\Home@fetch_all_meta')->name('app.mp.fetchallmedia');

	});

		

});


