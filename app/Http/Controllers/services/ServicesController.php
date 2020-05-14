<?php

namespace App\Http\Controllers\services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServicesModel;
use Validator;

class ServicesController extends Controller
{
    public function services(){
        return response()->json(ServicesModel::get(),200);
    }

    public function servicesById($service_id){
        $services =  ServicesModel::find($service_id);
        if(is_null($services)){
            return response()->json(['message' => 'Record Not Found'], 404);
        }
        return response()->json($services, 200);
    }

    public function servicesSave(Request $request){
        
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        $services = ServicesModel::create($request->all());
        return response()->json($services, 201);
    }

    public function servicesUpdate(Request $request, $id){
        $services = ServicesModel::find($id);
        if(is_null($services)){
            return response()->json(['message' => 'Record Not Found'], 404);
        }
        $services->update($request->all());
        return response()->json($services,200);
    }
    
    public function servicesDelete(Request $request, $id){
        $services = ServicesModel::find($id);
        if(is_null($services)){
            return response()->json(['message' => 'Record Not Found'], 404);
        }
         $services->delete();
        return response()->json(null, 204);
    }
}
