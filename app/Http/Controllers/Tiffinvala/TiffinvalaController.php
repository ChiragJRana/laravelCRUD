<?php

namespace App\Http\Controllers\Tiffinvala;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TiffinvalaModel;
use Validator;
use Illuminate\Support\Facades\Hash;
use DB;
class TiffinvalaController extends Controller
{
    public function tiffinman(){
        return response()->json(TiffinvalaModel::get(),200);
    }

    public function tiffinmanById($id){
        $tiffinman =  TiffinvalaModel::find($id);
        if(is_null($tiffinman)){
            return response()->json(['message' => 'Record Not Found'], 404);
        }
        return response()->json($tiffinman, 200);
    }

public function tiffinmanByPhone($phoneNumber){
    $tiffinvala = DB::select("select * from tiffinvala_master where phone_number = '$phoneNumber'");
    return response()->json($tiffinvala,200);
}

    public function tiffinmanVerify(Request $request){
        $rules=[
            'phone_number' => 'required',
            'password' => 'required|min:10'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        $check = DB::select("select password from tiffinvala_master where phone_number = '$request->phone_number'");

        if ($check != null && Hash::check($request->password, $check[0]->password) ){
            $requiredListofCustomers = DB::select("SELECT f_name, l_name, `address`, phone_number From customer_master WHERE id IN (Select s.customer_id FROM services AS s INNER JOIN tiffinvala_master AS tm ON s.tiffinvala_id = tm.id WHERE tm.phone_number = '$request->phone_number')");
            return response()->json($requiredListofCustomers, 201);
        }else{
            return response()->json(['message' => 'Record not found'],404);
        }
    }

    public function tiffinmanUpdate(Request $request, $id){
        $tiffinman = TiffinvalaModel::find($id);
        if(is_null($tiffinman)){
            return response()->json(['message' => 'Record Not Found'], 404);
        }
        $tiffinman->update($request->all());
        return response()->json($tiffinman,200);
    }

    public function tiffinmanDelete(Request $request, $id){
        $tiffinman = TiffinvalaModel::find($id);
        if(is_null($tiffinman)){
            return response()->json(['message' => 'Record Not Found'], 404);
        }
         $tiffinman->delete();
        return response()->json(null, 204);
    }
}
