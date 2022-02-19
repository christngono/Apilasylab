<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Subject;
use Illuminate\Support\Facades\Validator;

class QuizController extends Controller
{
    //function to add a classe
    public function index($id=null){
        
        $quiz = $id ? Quiz::find($id) : Quiz::all();

        return response()->json($quiz,200);
    }

    //function to add a class
    public function add(Request $request){
        $validator = Validator::make($request->all(),$this->rules());

        if(!$validator->fails()){
            $quiz = new Quiz();
            $quiz->question = $request->question;
            $quiz->a = $request->a;
            $quiz->b = $request->b;
            $quiz->c = $request->c;
            $quiz->d = $request->d;
            $quiz->answer = $request->answer;
            $quiz->resume_id = $request->resume_id;
            if($quiz->save()){
                return response()->json('Quiz saved successfully',200);
            }else{
                return response()->json('An error occured',500);
            }

        }else{
            return response()->json($validator->errors(),200);
        }
    }

    //function to edit a classe
    public function update(Request $request,$id){
        $subject = Subject::find($id);
        $validator = Validator::make($request->all(),$this->rules());

        if(!$validator->fails()){
            $quiz = Quiz::find($id);
            $quiz->question = $request->question;
            $quiz->a = $request->a;
            $quiz->b = $request->b;
            $quiz->c = $request->c;
            $quiz->d = $request->d;
            $quiz->answer = $request->answer;
            $quiz->resume_id = $request->resume_id;
            if($quiz->save()){
                return response()->json('Quiz saved successfully',200);
            }else{
                return response()->json('An error occured',500);
            }

        }else{
            return response()->json($validator->errors(),200);
        }
    
    }

    //function to delet a class
    public function delete($id){
        $quiz = Quiz::find($id);
        if($quiz->delete()){
            return response()->json('Quiz deleted successfully',200);
        }else{
            return response()->json('An error occured',500);
        }
    }

    //rules for course 
    function rules(){
        return [
            'question'=>'required',
            'a'=>'required',
            'b'=>'required',
            'c'=>'required',
            'd'=>'required',
            'answer'=>'required',
            'resume_id'=>'required',
        ];
    }
}
