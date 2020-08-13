<?php

namespace App\Http\Controllers\API;

use App\Visit;
use App\VisitStamp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class VisitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $visits = Visit::paginate(10);

        return response($visits);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate $request values
        $request->validate([
            'type' => 'required|string',
            'price' => 'required|numeric',
            'tva' => 'required|numeric',
        ]);

       

        //use of transaction to make sure that everything happen or nothing happen, to make sure stamps for the visit added 
        DB::beginTransaction();
        try {
            //create visit
            $visit = new Visit();
            $visit->type  =  $request->type;
            $visit->price =  $request->price;
            $visit->tva   =  $request->tva;
            
            $visit->save();
            // insert into visit_stamp values foreach, visit => id, stamp => each stamp id
            
            if($request->has('stamps')){
                // insert into visit_stamp values foreach, visit => id, stamp => each stamp id
                foreach ($request->stamps as $stamp) {
                    VisitStamp::create([
                        'visit' => $visit->id,
                        'stamp' => $stamp
                    ]);
                }
            }

            //commit the transaction
            DB::commit();
        } catch (\Exception $e) { // If we catch an exception, we will roll back so nothing gets messed
            DB::rollBack();
            throw $e;
        }


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


        //use of transaction to make sure that everything happen or nothing happen, (to avoid to delete stamps for a visit without adding the new ones if something happened)
        DB::beginTransaction();
        try {
            //delete from visit_stamp where visit = $id
            VisitStamp::where("visit", $id)->delete();

            // insert into visit_stamp values foreach, visit => id, stamp => each stamp id
            foreach ($request->stamps as $stamp) {
                VisitStamp::create([
                    'visit' => $id,
                    'stamp' => $stamp
                ]);
            }
            //commit the transaction
            DB::commit();
        } catch (\Exception $e) { // If we catch an exception, we will roll back so nothing gets messed
            DB::rollBack();
            throw $e;
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
        Visit::destroy($id);

        return response(201);
    }
}
