<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Validator;

class Controller_admin extends Controller
{
    //

    public function newUpload(Request $request){
        //return "Hello";
        //$userId = Auth::user()->id;
        $validator = \Validator::make($request->all(),[
                'utube' => 'required|url',
                'sdate' => 'required|date',
                'sdesc' => 'required',
                '_token' => 'required'
            ], [
                'utube.required' => 'Youtube URL is required',
                'sdate.required' => 'Input Service Date',
                'sdesc.required' => 'Input Service Description'
            ]);

            if ($validator->fails()) {
                // $resp['status'] = 'Failed'; $resp['message'] = $validator;
                return response()->json(['status'=>'Failed', 'message'=>$validator], 201);
                // return response()->json($resp, 201);
                // return redirect('post/create')
                //             ->withErrors($validator)
                //             ->withInput();
            }

            $utube = $request->input('utube');
            $sdate = $request->input('sdate');
            $sdesc = $request->input('sdesc');

            \DB::insert('insert into service (url, service_date, service_desc ) values (?, ?, ?)', [$utube, $sdate, $sdesc]);
            // $resp['status'] = 'OK'; $resp['message'] = 'Inserted Successfully';
            // return response()->json($resp, 200);    
            return response()->json(['status'=>'OK', 'message'=>'Inserted Successfully'], 200);    
        
    }

    public function newProgramme(Request $request){
        //return "Hello";
        //$userId = Auth::user()->id;
        $validator = \Validator::make($request->all(),[
                //'upJpg' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'sdate' => 'required|date',
                'edate' => 'required|date',
                '_token' => 'required'
            ], [
                'upJpg.required' => 'Image is required',
                'sdate.required' => 'Input Service Date',
                'edate.required' => 'Input Service Date',
            ]);

            if ($validator->fails()) {
                return response()->json(['status'=>'Failed', 'message'=>$validator], 201);
            }
                
            
            $upJpg = $request->input('upJpg');
            // $upJpg->move(public_path("images"), $new_name);
            $sdate = $request->input('sdate');
            $edate = $request->input('edate');

            \DB::insert('insert into programme (info, sdate, edate ) values (?, ?, ?)', [$upJpg, $sdate, $edate]);
             
            return response()->json(['status'=>'OK', 'message'=>'Inserted Successfully'], 200);    
        
    }

    public function getImage(Request $request){
        //return "Hello";
        //$userId = Auth::user()->id;
        $validator = \Validator::make($request->all(),[               
                '_token' => 'required'
            ], [                
                '_token.required' => 'Token required',
            ]);

            if ($validator->fails()) {
                return response()->json(['status'=>'Failed', 'message'=>$validator], 201);
            }
                
            
            // \DB::select('select * from programme')->limit(1)
            //                                     ->orderBy('id', 'desc');
            $programme = \DB::table('programme')->orderBy('id', 'desc')
                                            ->limit(1)
                                            ->get();
             
            return response()->json(['status'=>'OK', 'message'=>$programme], 200);    
        
    }

   
}
