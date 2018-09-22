<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Goal ;

class GoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *@param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user_id = Auth::id();
        $goal =  Goal::create([
            'user_id' => $user_id,
            'content' => $request['content'],
            'date' =>date('y-m-d'),
            'type'=>1
        ]);
        $goal = Goal::find($goal->id);

        return response()->json($goal);
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
//        dd($request);exit();
        $this->validate($request, [
            'content' => 'required'
        ]);
        $goal = Goal::find($id);
        $goal->type = 1;
        $goal->content = $request->get('content');
        $goal->sequence = $request->get('sequence');
        $goal->save();
        return $goal;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id) {

        $goal = Goal::find($id);
        if($goal->user_id==Auth::id()){
            $goal->status=3;
            $goal->save();
            return response()->json(['code'=>1,'msg'=>'Dropped!']);
        }else{
            return response()->json(['code'=>601,'msg'=>'Hei!']);

        }
    }
}
