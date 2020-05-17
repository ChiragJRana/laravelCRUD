<?php

namespace App\Http\Controllers\Tiffinvala;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TiffinvalaModel;
use Validator;
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
    public function tiffinmanSave(Request $request){
        $rules=[
            'f_name'=> 'required|min:3',
            'l_name'=> 'required|min:3',
            'm_name'=> 'required|min:3',
            'phone_number' => 'required',
            'password' => 'required|min:10'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        $tiffinman = TiffinvalaModel::create($request->all());
        return response()->json($tiffinman, 201);
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
