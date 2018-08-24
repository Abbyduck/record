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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Route::post('/home','HomeController@index')->name('home');
Route::post('/task', 'TaskController@create')->name('task');
Route::get('/task/delete/{id}', 'TaskController@delete')->name('task.delete');
Route::get('/task/s', function(){
        dd(11) ;

});
Route::get('/test-sql', function() {

    DB::enableQueryLog();

    App\Task::create([
//            'user_id'=>1,
            'content' => 'sdf',
        ]);

    return response()->json(DB::getQueryLog());
});
Route::get('user/name/{name}', function ($name) {
    return $name;
});