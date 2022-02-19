<?php

namespace App\Http\Controllers;
use App\Models\Classe;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    //function to add a classe
    public function index(){
        $class = Classe::all();

        return response()->json($class,200);
    }

    //function to add a class
    public function add(Request $request){
        if($request->name){
            $class = new Classe();
            $class->name = $request->name;
            if($class->save()){
                return response()->json('Class saved successfully',200);
            }else{
                return response()->json('An error occured',500);
            }

        }else{
            return response()->json('Class name required',400);
        }
    }

    //function to edit a classe
    public function update(Request $request,$id){
        $class = Classe::find($id);
        if($request->name){
            $class->name = $request->name;
            if($class->save()){
                return response()->json('Class updated with successfully',200);
            }else{
                return response()->json('An error occured',500);
            }
        }
        else{
            return response()->json('Class new name required',400);
        }

    }

    //function to delet a class
    public function delete($id){
        $class = Classe::find($id);
        if($class->delete()){
            return response()->json('Class deleted successfully',200);
        }else{
            return response()->json('An error occured',500);
        }
    }
}
