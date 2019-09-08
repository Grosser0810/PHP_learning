<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Group;


class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Group::latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'group' => 'required|string',

        ]);

        return Group::create([
            'group' => $request['group'],

        ]);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $group = Group::findOrFail($id);

        $this->validate($request,[
            'group' => 'required|string',
        ]);

        $group->update($request->all());
        return ['message' => 'Update'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $group = Group::findOrFail($id);


        $group->delete();

        return ['message'=>'User has deleted', 'data_group'=>$group];
    }

    public function search(){
        if ($search = \Request::get('q')) {
            $groups = Group::where(function($query) use ($search){
                $query->where('group','LIKE',"%$search%");
            })->paginate(20);
        }else{
            $groups = Group::latest()->paginate(10);
        }
        return $groups;
    }
}
