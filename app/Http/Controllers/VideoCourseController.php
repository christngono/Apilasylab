<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\VideoCourse;

class VideoCourseController extends Controller
{
    //display file 

    public function index($id=null){
        if($id){
            $video = VideoCourse::all()->where('course_id',$id);
        }else{
            $video = VideoCourse::all();
        }

        return response()->json($video,200);
    }


    public function add(Request $req){
        $imageName=null;
        Validator::make($req->all(),[
            'file' => 'required|mimes:csv,txt,xlx,xls,pdf,png,jpg,jpeg,mp4,mp3'
            ]);
    
            $fileModel = new VideoCourse();
    
            if($req->file()) {
                $imageName = time().'.'.$req->file->getClientOriginalExtension();
                $req->file->move(public_path('/uploadedcourses'), $imageName);
                
                $imagePath = 'uploadedcourses/'.$imageName;

                $fileModel->file = $imagePath;
                $fileModel->title = $req->title;
                $fileModel->description = $req->description;
                $fileModel->course_id = $req->course_id;
                $fileModel->save();
    
                return response()->json('Cour video Ajouter avec success',200);
            }else{
                return response()->json(['error'=>'Aucune video n\'as ete selectionner !!!'],200);
            }


                return $imageName;
       
    }

    public function views(Request $request,$id){
        $video = VideoCourse::find($id);

        
    }
}
