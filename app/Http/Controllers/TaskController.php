<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task ;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\Response;

class TaskController extends Controller
{

    /**
     * Show the form for creating a new resource.
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request)
    {
        $user_id = Auth::id();
        $task =  Task::create([
            'user_id' => $user_id,
            'content' => $request['content'],
        ]);
        $task = Task::find($task->id);

        return response()->json($task);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  int  $status
     * @return \Illuminate\Http\Response
     */
    public function updateStatus($id,$status) {

        $task = Task::find($id);
        if($task->user_id==Auth::id()){
            $task->status=$status;
            $task->save();
            return response()->json(['code'=>1,'msg'=>'Dropped!']);
        }else{
            return response()->json(['code'=>601,'msg'=>'Hei!']);

        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $task = Task::find($id);
        return $task;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $this->validate($request, [
            'content' => 'required'
        ]);
        $task = Task::find($id);
        $task->deadline = $request->get('deadline');
        $task->content = $request->get('content');
        $task->color = $request->get('color');
        $task->sequence = $request->get('sequence');
        $task->save();
        return $task;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


}
