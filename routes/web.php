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

Route::group(['prefix'=>'Apps'],function(){

	Route::group(['prefix'=>'Media-Player'],function(){

		Route::get('/',function(){
			return view('User.mediaplayer');
		})->name('app.mp.home');

		Route::post('fetchmedia','User\Apps\MediaPlayer\Home@fetchmedia')->name('app.mp.fetchmedia');

		Route::post('fetchallmedia','User\Apps\MediaPlayer\Home@fetch_all_media_meta')->name('app.mp.fetchallmedia');

	});

		

});


