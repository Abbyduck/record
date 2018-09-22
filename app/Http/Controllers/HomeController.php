<?php

namespace App\Http\Controllers;

use App\Goal;
use App\Schedule;
use Illuminate\Http\Request;
use App\Task ;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today =date('Y-m-d');
        //get no schedule date for 30days

        $date_30 = date("Y-m-d", strtotime('-30day'));

        $schedule_dates = DB::table('schedule')->where('date','>',$date_30)->pluck('date');
        for($i=0;$i<=30;$i++) {
            $days[] = date("Y-m-d", strtotime(' -'. $i . 'day'));
        }
        $disable_dates=array_values(array_diff($days,json_decode(json_encode($schedule_dates,true))));

        return view('home',[
            'tasks' => Task::all()->where('user_id','=',Auth::id())->where('status','!=',3)->sortBy('sequence'),
            'goals' => Goal::all()->where('user_id','=',Auth::id())->where('status','!=',3)->where('date','=',$today)->sortBy('sequence'),
            'schedule'=>Schedule::all()->where('user_id','=',Auth::id())->where('date','=',$today)->first(),
            'disable_dates'=>json_encode($disable_dates,true)

        ]);
    }

}
