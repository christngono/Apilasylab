<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{

    //function to get all messages
    public function index(){

        $data = Message::all();

        return response()->json($data,200);
    }

    //function to add a message
    public function add(Request $request){
        $rules = $this->getRules();
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        $message = Message::create([
            'name'=>$request->name,
            'content'=>$request->content,
            'date'=>$request->date,
            'user_id'=>$request->user_id,
            'receiver'=>$request->receiver,
        ]);
        
        if($message->save()){
            $data = ['data'=>$message,'result'=>'Inséré avec succès'];

            return response()->json($data,200);
        }else{
            return response()->json(['data'=>'Une erreur s\'est produite'],500);
        }
    }

    //function to update data 
    public function update(Request $request,$id){

        $rules =  $this->getRules();
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        $message = Message::find($id);
        $message->name = $request->name;
        $message->content = $request->content;
        $message->date = $request->date;
        $message->user_id = $request->user_id;
        $message->receiver = $request->receiver;

        if($message->save()){
            return response()->json($message,201);
        }else{
            return response()->json(['error'=>"Une erreur s'est produite"],206);
        }
    }


    //function to delete
    public function delete($id){
        $message = Message::find($id);
        if($message->delete()){
            return response()->json(['data'=>'Supprimé avec succès'],200);
        }else{
            return response()->json(['data'=>"Une erreur s'est produite"],500);
        }

    }

    //function containing message rules
    function getRules(){
        return [
            'name'=>'required',
            'content'=>'required',
            'date'=>'nullable',
            'user_id'=>'required',
            'receiver'=>'required'
        ];
    }
}
