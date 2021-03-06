<?php

namespace App\Http\Controllers\API;

use App\CustomerVisit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CustomerVisitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers_visits = DB::table('customer_visits')
        ->join('customers', 'customers.matricule', '=', 'customer_visits.customer')
        ->join('visits', 'visits.id', '=', 'customer_visits.visit')
        ->select('customers.full_name', 'customers.matricule', 'visits.type', 'customer_visits.id','customer_visits.created_at', 'customer_visits.total')
        ->latest()
        ->paginate(10);

        return response($customers_visits);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CustomerVisit::destroy($id);
    
        return response(201);
    }

    public function getStatistics(){

        $thisYear = CustomerVisit::whereYear('created_at', Carbon::now()->year)
                                    ->count();
        $thisMonth = CustomerVisit::whereYear('created_at', Carbon::now()->year)
                                    ->whereMonth('created_at', Carbon::now()->month)
                                    ->count();
        $today = CustomerVisit::whereYear('created_at', Carbon::now()->year)
                                    ->whereMonth('created_at', Carbon::now()->month)
                                    ->whereDay('created_at', Carbon::now()->day)
                                    ->count();

        $array =  array(
            'year' => $thisYear, 
            'month' => $thisMonth, 
            'today' => $today, 
        );

        return response($array);
    }
}
