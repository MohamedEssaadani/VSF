<?php

namespace App\Http\Controllers\API;

use App\Visit;
use App\VisitStamp;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        return response(Visit::all());
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validate $request values
        $request->validate([
            'type' => 'required|string',
            'price' => 'required|numeric', 
            'tva' => 'required|numeric', 
        ]);

        //get the visit by $id and update data with update()
        $visit = Visit::findOrFail($id)
                    ->update([
                        'type' => $request->type,
                        'price' => $request->price,
                        'tva' => $request->tva,
                    ]);

        //delete from visit_stamp where visit = $id
        VisitStamp::where("visit", $id)->delete();

        // insert into visit_stamp values foreach, visit => id, stamp => each stamp id
        foreach($request->stamps as $stamp){
            VisitStamp::create([
                'visit' => $id,
                'stamp' => $stamp 
            ]);
        }

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
        //
    }
}
