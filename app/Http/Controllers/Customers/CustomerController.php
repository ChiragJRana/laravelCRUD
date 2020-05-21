<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerModel;
use Illuminate\Support\Facades\Hash;
use Validator;
use DB;
class CustomerController extends Controller
{
    private $validated = false;
    private $validatedemail = '';
    public function customer(){
        return response()->json(CustomerModel::get(),200);
    }

    public function customerByEmail($email){

    //     if ($validatedemail != '' && $validated){
    //         $customer = DB::select("select * from customer_master WHERE  email = '$email' Limit 1");

    // }
    //     return response()->json($customer,200);
    }
    public function validateEmail(Request $request){
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:10'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        $check = DB::select("select password from customer_master where email = '$request->email'");

        if ($check != []){
            if(Hash::check($request->password, $check[0]->password)){

                $requiredListofCustomers = DB::select("select * from customer_master where email = '$request->email'");
            return response()->json($requiredListofCustomers, 201);

        }else{
                return response()->json(['message' => 'Incorrect Password'],400);
            }
        }else{
            return response()->json(['message' => 'Reccord Not Found Sign Up Rather'],404);
        }
        // return response()->json(, 201);
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

    public function customerUpdate(Request $request){
        $email = $request->email;
        $id = DB::select("select id from customer_master WHERE email = '$email'")[0];

        $customer = CustomerModel::find($id->id);

        if(is_null($customer)){
            return response()->json(['message' => 'Record Not Found'], 404);
        }
        $requestData =$request->all();

        if($request->password != $customer->password){
            $requestData['password'] = Hash::make($request->password);
        }

        $beforeupdate = $customer->Present_member;
        $customer->update($requestData);
        $afterupdate = $customer->Present_member;
        if($beforeupdate == 0 and $afterupdate == 1){
            DB::insert("Insert into services (customer_id,tiffinvala_id,working) values ($id->id, (select id from tiffinvala_master where number_of_orders IN (select min(number_of_orders) from tiffinvala_master) Limit 1),$customer->Present_member)");
            DB::update("update tiffinvala_master SET number_of_orders = number_of_orders + 1 WHERE id = (SELECT tiffinvala_id FROM services ORDER BY service_id DESC LIMIT 1)");
        }
        if($beforeupdate == 1 and $afterupdate == 0){
            // $tiffinmanid = DB::select('select tiffinvala_id from services where customer_id = ?', [$id->id]);
            DB::update('update tiffinvala_master SET number_of_orders = number_of_orders - 1 WHERE id = (select tiffinvala_id from services where customer_id = ?)',[$id->id]);
            DB::delete('delete from services where customer_id = ?', [$id->id]);
        }
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
