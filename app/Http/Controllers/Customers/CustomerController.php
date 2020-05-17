<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerModel;
use App\Models\ServicesModel;
use Validator;
use DB;
class CustomerController extends Controller
{

    public function customer(){
        return response()->json(CustomerModel::get(),200);
    }

    public function customerByEmail($email){
        $customer = DB::select("select * from customer_master WHERE  email = '$email' Limit 1");
        
        return response()->json($customer,200);
    }

    public function customerById($id){

        $customer =  CustomerModel::find($id);
        if(is_null($customer)){
            return response()->json(['message' => 'Record Not Found'], 404);
        }
        return response()->json($customer, 200);
    }

    // public function customerSave(Request $request){
    //     $rules=[
    //         'f_name'=> 'required|min:3',
    //         'l_name'=> 'required|min:3',
    //         'm_name'=> 'required|min:3',
    //         'phone_number' => 'required',
    //         'address' => 'required',
    //         'pincode' => 'required'
    //     ];
    //     $validator = Validator::make($request->all(), $rules);
    //     if($validator->fails()){
    //         return response()->json($validator->errors(),400);
    //     }
    //     $customer = CustomerModel::create($request->all());


    //     // return response()->json($customer->value('password'), 201);
    //     return
    // }

    public function customerUpdate(Request $request, $id){
        $customer = CustomerModel::find($id);
        if(is_null($customer)){
            return response()->json(['message' => 'Record Not Found'], 404);
        }
        $customer->update($request->all());
        return response()->json($customer,200);
    }

    public function customerDelete(Request $request, $id){
        $customer = CustomerModel::find($id);
        if(is_null($customer)){
            return response()->json(['message' => 'Record Not Found'], 404);
        }
         $customer->delete();
        return response()->json(null, 204);
    }

}
