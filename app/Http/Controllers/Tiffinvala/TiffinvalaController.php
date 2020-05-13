<?php

namespace App\Http\Controllers\Tiffinvala;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TiffinvalaModel;
class TiffinvalaController extends Controller
{
    public function tifinman(){
        return response()->json(TiffinvalaModel::get(),200);
    }

    public function customerById($id){
        $customer =  TiffinvalaModel::find($id);
        if(is_null($customer)){
            return response()->json(['message' => 'Record Not Found'], 404);
        }
        return response()->json($customer, 200);
    }

    public function customerSave(Request $request){
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
        $customer = TiffinvalaModel::create($request->all());
        return response()->json($customer, 201);
    }

    public function customerUpdate(Request $request, $id){
        $customer = TiffinvalaModel::find($id);
        if(is_null($customer)){
            return response()->json(['message' => 'Record Not Found'], 404);
        }
        $customer->update($request->all());
        return response()->json($customer,200);
    }
    
    public function customerDelete(Request $request, $id){
        $customer = TiffinvalaModel::find($id);
        if(is_null($customer)){
            return response()->json(['message' => 'Record Not Found'], 404);
        }
         $customer->delete();
        return response()->json(null, 204);
    }
}
