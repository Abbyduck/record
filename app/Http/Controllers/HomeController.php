<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task ;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
    public function index()
    {
//        dd(Auth::id());
        return view('home',[
        'tasks' => Task::all()->where('user_id','=',Auth::id())->where('status','!=',3)->sortBy('sequence')]);
    }
}
