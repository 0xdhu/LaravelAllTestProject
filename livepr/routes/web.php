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
 
Route::get('/', function () {
    return view('welcome');
});

// use App\Http\Middleware\StudentMid;
// Route::get('student/{id}','StudentController@test')->middleware(StudentMid::class);
// Route::get('student/{id}','StudentController@test')->middleware('student');
Route::group(['middleware' => ['auth']], function(){
	// Route::get('student','StudentController@index')->name('student');
	Route::resource('users','UserController');
	Route::resource('commongenre','CommongenresController');
	Route::resource('categories','CategoriController');
	Route::resource('videos','VideoController');
});

/////////-------TVBOX api --------------////
Route::post('login_tv', 'UserController@tv_login');
Route::get('categori_tv', 'CategoriController@tv_all');
Route::get('video_tv/{name}', 'VideoController@tv_all');
////////-------TVBOX api --------------////
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
