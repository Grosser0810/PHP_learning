<?php

namespace App\Http\Controllers\API;

use App\Manufacturer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Manufacturer::latest()->paginate(10);
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
            'manufacturer' => 'required|string',

        ]);

        return Manufacturer::create([
            'manufacturer' => $request['manufacturer'],

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
        $manufacturer = Manufacturer::findOrFail($id);

        $this->validate($request,[
            'manufacturer' => 'required|string',

        ]);

        $manufacturer->update($request->all());
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
        $manufacturer = Manufacturer::findOrFail($id);


        $manufacturer->delete();

        return ['message'=>'User has deleted', 'data_manufacturer'=>$manufacturer];
    }

    public function search(){
        if ($search = \Request::get('q')) {
            $manufacturers = Manufacturer::where(function($query) use ($search){
                $query->where('manufacturer','LIKE',"%$search%")
                    ->orWhere('id','LIKE',"%$search%");

            })->paginate(20);
        }else{
            $manufacturers = Manufacturer::latest()->paginate(10);
        }
        return $manufacturers;
    }
}
