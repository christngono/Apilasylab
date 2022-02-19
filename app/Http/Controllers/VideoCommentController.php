<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VideoComment;

class VideoCommentController extends Controller
{
    //function to get all messsages
    public function index($id=null){
        if($id){
            $comment = VideoComment::first()->where('id',$id);
        }else{
            $comment = VideoComment::all();
        }

        return response()->json($comment,200);
    }

     //function to add videocomment
     public function add(Request $request){
        if($request->message){
            $comment = new VideoComment();
            $comment->message = $request->message;
            $comment->user_id = $request->user_id;
            $comment->save();

            return response()->json('Commentaire enregistre avec success',201);

        }else{

            return response()->json('Une erreur c\'est produit lors de l\'enregistrement du commentaire',500);
        }
    }

    //function to update videocomment
    public function update(Request $request,$id){
        if($request->message){
            $comment = VideoComment::find($id);
            $comment->message = $request->message;
            $comment->save();

            return response()->json('Commentaire Modifier avec success',200);

        }else{

            return response()->json('Le nouveau message est indefinir',200);
        }
    }

    //public function delete
    public function delete($id){
        $comment = VideoComment::find($id);
        if($comment->delete()){
            return response()->json('Commentaire Suprimer avec success',200);
        }else{
            return response()->json('Une erreur c\'est produit lors de la suppression',500);
        }
    }

}
