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
}
