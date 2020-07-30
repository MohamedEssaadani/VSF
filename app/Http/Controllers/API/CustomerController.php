<?php

namespace App\Http\Controllers\API;

use App\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::latest()->paginate(10);
        
        return response($customers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        //validate attributes
        $request->validate([
            'matricule' => 'required|string',
            'full_name' => 'required|string',
            //moroccan number ex : 0655669966 or +212696966555
            'phone' => 'required|string|min:10|max:12',
            'car_brand' => 'required|string'
        ]);
        
        //create new customer
        $customer = new Customer();
        $customer->matricule = $request->matricule;
        $customer->full_name= $request->full_name;
        $customer->phone = $request->phone;
        $customer->car_brand = $request->car_brand;

        //save to db
        $customer->save();

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($matricule)
    {
        //get the customer who have $matricule then delete it
        Customer::where("matricule", $matricule)->delete();

        return response(201);
    }
}
