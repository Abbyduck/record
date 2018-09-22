<?php

namespace App\Http\Controllers;

use App\Schedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDO;

class ScheduleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function schedule()
    {
        $user_id = Auth::id();

        $date = $_POST['date'];
        $schedule = Schedule::where('user_id', '=', $user_id)->where('date', '=', $date)->first();
        if ($schedule) {
            $schedule->content = $_POST['data'];
            $schedule->save();
        } else {
            $schedule = Schedule::create([
                'user_id' => $user_id,
                'content' => $_POST['data'],
                'date' => date('y-m-d'),
            ]);
        }
        return response()->json($schedule);
    }

    public function getSchedule()
    {
        $user_id = Auth::id();

        $date = $_GET['date'];
        $today = date('Y-m-d');
        $schedule = Schedule::where('user_id', '=', $user_id)->where('date', '=', $date)->first();
        if(!$schedule && $date>=$today){
            $view = view('schedule.model')->render();
            $data = array('code'=>1,'data'=>$view);

        }elseif($schedule){
            $data = array('code'=>1,'data'=>$schedule->content);
        }else{
            $data = array('code'=>2,'data'=>'No schedules!');
        }
        return response()->json($data);
    }

}
