<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerModel;
use Validator;
use Illuminate\Support\Facades\Hash;
use DB;
class Customer extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(CustomerModel::get(),200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $exist = null;
        $rules=[
            'f_name'=> 'required|min:3',
            'l_name'=> 'required|min:3',
            'm_name'=> 'required|min:3',
            'email' => 'required',
            'phone_number' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        $exist = DB::select("select * from customer_master where email = '$request->email' OR phone_number = '$request->phone_number'");
        if($exist != null){
            return response()->json(['message' => 'Already Exists'], 200);
        }
        $requestData = $request->all();
        $requestData['password'] = Hash::make($request->password);
        $customer = CustomerModel::create($requestData);
        DB::insert("Insert into services (customer_id,tiffinvala_id,working) values ((select id from customer_master ORDER BY id DESC LIMIT 1), (select id from tiffinvala_master where number_of_orders IN (select min(number_of_orders) from tiffinvala_master) Limit 1), '$customer->Present_member')");

        DB::update("update tiffinvala_master SET number_of_orders = number_of_orders + 1 WHERE id = (SELECT tiffinvala_id FROM services ORDER BY service_id DESC LIMIT 1)");
        return response()->json($requestData, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer =  CustomerModel::find($id);
        if(is_null($customer)){
            return response()->json(['message' => 'Record Not Found'], 404);
        }
        return response()->json($customer, 200);
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
    public function update(Request $request, $id)
    {
        $customer = CustomerModel::find($id);
        if(is_null($customer)){
            return response()->json(['message' => 'Record Not Found'], 404);
        }
        $customer->update($request->all());
        return response()->json($customer,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = CustomerModel::find($id);
        if(is_null($customer)){
            return response()->json(['message' => 'Record Not Found'], 404);
        }
         $customer->delete();
        return response()->json(null, 204);
    }
}
