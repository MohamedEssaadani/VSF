<?php

namespace App\Http\Controllers\API;

use App\Stamp;
use App\StampVisit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StampController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(Stamp::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'description' => 'required|string', 
            'price' => 'required|numeric'
        ]);

        Stamp::create([
            'type' => $request->type,
            'description' => $request->description,
            'price' => $request->price
        ]);

        return response(201);
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
        $request->validate([
            'type' => 'required|string', 
            'description' => 'required|string', 
            'price'=> 'required|numeric'
        ]);

        Stamp::where('id', $id)->update([
            'type' => $request->type, 
            'description' => $request->description, 
            'price' => $request->price
        ]);

        return response(201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete from visit_stamp first
        StampVisit::where('stamp', $id)->delete();
        //delete now stamp
        Stamp::destroy($id);

        return response(201);
    }
}
