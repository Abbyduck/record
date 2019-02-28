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
Route::post('/task/update/{id}', 'TaskController@update')->name('task.update');
Route::post('/task/updateStatus/{id}/status/{status}', 'TaskController@updateStatus')->name('task.updateStatus');
Route::post('/schedule', 'ScheduleController@schedule')->name('schedule');
Route::get('/getSchedule', 'ScheduleController@getSchedule')->name('getSchedule');

Route::get('/test', function(){
    $date_30 = date("Y-m-d", strtotime('-30day'));
    $schedule_dates = Illuminate\Support\Facades\DB::select('SELECT date FROM schedule  WHERE date>:date', ['date' => $date_30]);
    $schedule_dates = Illuminate\Support\Facades\DB::table('schedule')->where('date','>',$date_30)->pluck('date');
    for($i=0;$i<=30;$i++) {
        $days[] = date("Y-m-d", strtotime(' -'. $i . 'day'));
    }

//    $disable_dates=array_diff($days,$schedule_dates);
    var_dump($days);
    var_dump($schedule_dates);
    var_dump(json_decode(json_encode($schedule_dates,true)));
});
Route::get('/test2', function(){
        return view('test2');

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