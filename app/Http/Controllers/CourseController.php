<?php

namespace App\Http\Controllers;
use App\Models\Course;
use App\Models\Subject;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    //function to get all courses
    public function index($name=null){
        if($name){
            $subject = Subject::where('name',$name)->get('id');
            $arr = Array();
            foreach($subject as $row){
                array_push($arr,$row['id']);
            }
            
            $course = Course::all()->where('subject_id',$arr[0]);
        }else{
            $course = Course::all();
        }

        return response()->json($course,200);
    }

    //function to get one course
    public function getOneCourse($id = null){
        $course = Course::where('id',$id)->first();
        return response()->json($course,200);
    }

    //function to add a course
    public function add(Request $request){
        $rules = $this->rules();
        $validator = Validator::make($request->all(),$rules);

        if(!$validator->fails()){
            $course = new Course();
            $course->name = $request->name;
            $course->createAt = $request->createAt;
            $course->view = $request->view;
            $course->subject_id = $request->subject_id;
            $course->type = $request->type;

            if($course->save()){
                return response()->json('Course saved successfully',200);
            }else{
                return response()->json('An error occured',500);
            }

        }else{
            return response()->json($validator->errors(),400);
        }
    }

    //function to edit a course
    public function update(Request $request,$id){
        $course = Course::find($id);
        if($request->name){
            $course->name = $request->name;
            if($course->save()){
                return response()->json('Course updated with successfully',200);
            }else{
                return response()->json('An error occured',500);
            }
        }
        else{
            return response()->json('All fields are required',400);
        }

    }

    //function to update number of views
    public function updateCourseViews(Request $request,$id){
        $course = Course::find($id);
        $view = (int)$course->view+1;
        $course->view = $view;

        if($course->save()){
            return response()->json('Course Views updated with successfully',200);
        }else{
            return response()->json('An error occured',500);
        }

    }

    //function to delet a class
    public function delete($id){
        $course = Course::find($id);
        if($course->delete()){
            return response()->json('Course deleted successfully',200);
        }else{
            return response()->json('An error occured',500);
        }
    }
    
    //rules for course 
    function rules(){
        return [
            'name'=>'required',
            'createAt'=>'nullable',
            'view'=>'required',
            'subject_id'=>'required',
            'type'=>'required'
        ];
    }
}
