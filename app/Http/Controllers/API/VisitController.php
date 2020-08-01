<?php

namespace App\Http\Controllers\API;

use App\Visite;
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
        return response(Visite::all());
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
            'narfa' => 'required|numeric',
            'kitonse' => 'required|numeric',
            'local' => 'required|numeric',
        ]);

        //get the visit by $id and update data with update()
        $visit = Visite::findOrFail($id)
                    ->update([
                        'type' => $request->type,
                        'price' => $request->price,
                        'tva' => $request->tva,
                        'narfa' => $request->narfa,
                        'kitonse' => $request->kitonse,
                        'local' => $request->local,
                        'total' => $request->total
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
        //
    }
}
