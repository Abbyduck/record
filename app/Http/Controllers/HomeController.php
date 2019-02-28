<?php

namespace App\Http\Controllers;

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
//            'tasks' => Task::where('user_id','=',Auth::id())->whereRaw('if(date = DATE_FORMAT(now(),"%Y-%m-%d") or updated_at > DATE_FORMAT(now(),"%Y-%m-%d"),status!=3,status=1 )')
//                    ->orderBy('sequence')
//                    ->select('id','content',DB::raw('(case when date < DATE_FORMAT(now(),"%Y-%m-%d") then concat("(",DATE_FORMAT(date,"%m-%d"),")") else "" end  ) as date '),DB::raw('(case when status = 2  then "checked" else "" end  ) as status '),DB::raw('(case when date < DATE_FORMAT(now(),"%Y-%m-%d") then "red" else "green" end  ) as color '),'sequence' )->get(),
            'schedule'=>Schedule::all()->where('user_id','=',Auth::id())->where('date','=',$today)->first(),
            'disable_dates'=>json_encode($disable_dates,true),
            'tasks'=>array()
        ]);
    }

}
