<?php

namespace App\Http\Controllers;
use App\Models\Resume;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class ResumeController extends Controller
{
     //function to get all resume or one resume
     public function index($id=null){
        
        $resume = $id ? Resume::find($id) : Resume::all();

        return response()->json($resume,200);
    }

    //function to add a course
    public function add(Request $request){
        $rules = $this->rules();
        $validator = Validator::make($request->all(),$rules);

        if(!$validator->fails()){
            $resume = new Resume();
            $resume->title = $request->title;
            $resume->introduction = $request->introduction;
            $resume->rappel = $request->rappel;
            $resume->subtitle = $request->subtitle;
            $resume->astuce = $request->astuce;
            $resume->exemple = $request->exemple;
            $resume->attention = $request->attention;
            $resume->conclusion = $request->conclusion;
            $resume->course_id = $request->course_id;
            $resume->subtitle_content = $request->subtitle_content;

            $imageName = time().'.'.$request->topimage->getClientOriginalExtension();
            $request->topimage->move(public_path('/uploadedimages'), $imageName);
            
            $imagePath = 'uploadedimages/'.$imageName;
            $resume->topimage = $imagePath;

            $imageName1 = time().'_1'.'.'.$request->bottomimage->getClientOriginalExtension();
            $request->bottomimage->move(public_path('/uploadedimages'), $imageName1);
            
            $imagePath1 = 'uploadedimages/'.$imageName1;
            $resume->bottomimage = $imagePath1;


            if($resume->save()){
                return response()->json('Resume saved successfully',200);
            }else{
                return response()->json('An error occured',500);
            }

        }else{
            return response()->json($validator->errors(),400);
        }
    }

    //function to edit a course
    public function update(Request $request,$id){
        $rules = $this->rules();
        $validator = Validator::make($request->all(),$rules);

        if(!$validator->fails()){
            $resume = Resume::find($id);
            $resume->title = $request->title;
            $resume->introduction = $request->introduction;
            $resume->rappel = $request->rappel;
            $resume->subtitle = $request->subtitle;
            $resume->astuce = $request->astuce;
            $resume->exemple = $request->exemple;
            $resume->attention = $request->attention;
            $resume->conclusion = $request->conclusion;
            $resume->course_id = $request->course_id;
            $resume->subtitle_content = $request->subtitle_content;

            if($resume->save()){
                return response()->json('Resume updated with successfully',200);
            }else{
                return response()->json('An error occured',500);
            }
        }
        else{
            return response()->json($validator->errors(),400);
        }

    }

    //function to delet a class
    public function delete($id){
        $resume = Resume::find($id);
        if($resume->delete()){
            return response()->json('Resume deleted successfully',200);
        }else{
            return response()->json('An error occured',500);
        }
    }
    
    //rules for course 
    function rules(){
        return [
            'title'=>'required',
            'introduction'=>'required',
            'rappel'=>'required',
            'subtitle'=>'required',
            'astuce'=>'required',
            'exemple'=>'required',
            'attention'=>'required',
            'conclusion'=>'required',
            'course_id'=>'required',
            'subtitle_content'=>'required',
            'topimage'=>'required',
            'bottomimage'=>'required'
        ];
    }
}
