<?php

namespace App\Http\Controllers;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    //function to add a classe
    public function index(){
        $subject = Subject::all();

        return response()->json($subject,200);
    }

    //function to add a class
    public function add(Request $request){
        if($request->name && $request->classe_id){
            $subject = new Subject();
            $subject->name = $request->name;
            $subject->classe_id = $request->classe_id;
            if($subject->save()){
                return response()->json('Subject saved successfully',200);
            }else{
                return response()->json('An error occured',500);
            }

        }else{
            return response()->json('All fields are required',400);
        }
    }

    //function to edit a classe
    public function update(Request $request,$id){
        $subject = Subject::find($id);
        if($request->name){
            $subject->name = $request->name;
            if($subject->save()){
                return response()->json('Subject updated with successfully',200);
            }else{
                return response()->json('An error occured',500);
            }
        }
        else{
            return response()->json('All fields are required',400);
        }

    }

    //function to delet a class
    public function delete($id){
        $subject = Subject::find($id);
        if($subject->delete()){
            return response()->json('Subject deleted successfully',200);
        }else{
            return response()->json('An error occured',500);
        }
    }
}
