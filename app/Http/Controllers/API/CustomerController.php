<?php

namespace App\Http\Controllers\API;

use App\Customer;
use App\CustomerVisit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

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
            //moroccan number ex : 0655669966 
            'phone' => 'required|string|size:10',
            'car_brand' => 'required|string',
            'visit' => 'required|integer'
        ]);
        
        //if record doesnt exist we will create it
        if(!Customer::where('matricule', $request->matricule)->exists())
        {
             //create new customer object
             $customer = new Customer();
             $customer->matricule = $request->matricule;
             $customer->full_name= $request->full_name;
             $customer->phone = $request->phone;
             $customer->car_brand = $request->car_brand;
 
             //save to db
             $customer->save();
        }
    

        //customers_visites table
        CustomerVisit::create([
            "customer" => $request->matricule,
            "visit" => $request->visit, 
            "total" => 15
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
    public function update(Request $request, $matricule)
    {
       //validate attributes
       $request->validate([
        'matricule' => 'required|string',
        'full_name' => 'required|string',
        //moroccan number ex : 0655669966 
        'phone' => 'required|string|size:10',
        'car_brand' => 'required|string'
        ]);
    
        //get the customer with $matricule & update data with update()
        $customer = Customer::where("matricule", $matricule)
                    ->update([
                        "full_name"=> $request->full_name,
                        "phone" => $request->phone, 
                        "car_brand" => $request->car_brand
                         ]);

        return response(201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($matricule)
    {
        //get the customer who have $matricule & delete it first from pivot table
        CustomerVisit::where("customer", $matricule)
                        ->delete();
        //get the customer who have $matricule then delete it
        Customer::where("matricule", $matricule)
                ->delete();

        return response(201);
    }
}
