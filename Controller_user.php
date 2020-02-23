<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SendGuestMail;

class Controller_user extends Controller
{
    //
    public function sendMail(Request $request){

        $validator = \Validator::make($request->all(),[
            // 'upJpg' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'fname' => 'required',
            'pnum' => 'required',
            'message' => 'required',
            'email' => 'required',
            '_token' => 'required'
        ], [
            'message.required' => 'Please fill all fields',
            
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=>'Failed', 'message'=>$validator], 201);
        }
            

        $fname = $request->input('fname');
        $pnum = $request->input('pnum');
        $message = $request->input('message');
        $email = $request->input('email');

        $details = [

            'title' => 'Mail from '.$fname,
    
            'body' => $message,

            'phone' => $pnum,

            'from' => $email
    
        ];

        \Mail::to('vicformidable@gmail.com')->send(new SendGuestMail($details));
        
        if(count(\Mail::failures()) > 0){
            return response()->json(['status'=>'Failed', 'message'=>'Mail not Sent'], 201);            
        }else{
            return response()->json(['status'=>'OK', 'message'=>'Mail Sent'], 200);
        }
    

    }

    public function getGallery(Request $request){
        //return "Hello";
        //$userId = Auth::user()->id;
        $validator = \Validator::make($request->all(),[               
                'id' => 'required'
            ], [                
                'id.required' => 'Display id required',
            ]);

            if ($validator->fails()) {
                return response()->json(['status'=>'Failed', 'message'=>$validator], 201);
            }

            $id = $request->input('id'); 
           
            $programme = \DB::table('gallery')->where('thumbId', '=', $id)
                                            ->get();
             
            return response()->json(['status'=>'OK', 'message'=>$programme], 200);    
        
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
   

    public function getVideo(Request $request){
        
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
            $service = \DB::table('service')->orderBy('id', 'desc')
                                            ->limit(2)
                                            ->get();
             
            return response()->json(['status'=>'OK', 'message'=>$service], 200);    
        
    }

    public function getThumbnail(Request $request){
        
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
            $service = \DB::table('thumbnail')->get();
             
            return response()->json(['status'=>'OK', 'message'=>$service], 200);    
        
    }
}
