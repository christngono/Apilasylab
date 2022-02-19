<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    //function to get all users
    public function index(){

        $data = User::all()->where('status','1');

        return response()->json($data,200);
    }


    //function to add a user
    public function add(Request $request){
        $rules = $this->getRules();
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        $user = User::create([
            'name'=>$request->name,
            'classroom'=>$request->classroom,
            'bornAt'=>$request->bornAt,
            'biography'=>$request->biography,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),

        ]);
        
        if($user->save()){
            $data = ['data'=>$user,'result'=>'Inséré avec succès'];

            return response()->json($data,200);
        }else{
            return response()->json(['data'=>'Une erreur s\'est produite'],500);
        }
    }

    public function login(Request $request){
        $rules = [
            'phone'=>'required',
            'password'=>'required'
        ];

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        $usercount = User::all()->where('phone',$request->phone)->count();
	
        if($usercount>0){
	    $user = User::all();
	    foreach($user as $row){
		if($row['phone']===$request->phone){
		   $hashPwd = $row['password'];
		   $id = (int)$row['id'];
		}
	    }
            if(Hash::check($request->password,$hashPwd)){
		$user = User::find($id);
	        return response()->json(['data'=>$user,'result'=>'Utilisateur connecter avec success'],200);
	    }
	}else{
		return response()->json(['error'=>'No account exist with this credentials'],404);
	}
    }

    //function to update data 
    public function update(Request $request,$id){

        $rules =  $this->getRules();
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        $user = User::find($id);
        $user->name = $request->name;
        $user->classroom = $request->classroom;
        $user->bornAt = $request->bornAt;
        $user->biography = $request->biography;
        $user->phone = $request->phone;
        $user->email = $request->email;

        if($user->save()){
            return response()->json($user,201);
        }else{
            return response()->json(['error'=>"Une erreur s'est produite"],206);
        }
    }


    //function to disable
    public function disable($id){
        $user = User::find($id);
        $user->status = '0';
        if($user->save()){
            return response()->json(['data'=>'Desactivé avec succès'],200);
        }else{
            return response()->json(['data'=>"Une erreur s'est produite"],500);
        }
    }

    //function to enable
    public function enable($id){
        $user = User::find($id);
        $user->status = '1';
        if($user->save()){
            return response()->json(['data'=>'Activé avec succès'],200);
        }else{
            return response()->json(['data'=>"Une erreur s'est produite"],500);
        }
    }

    //function to delete user
    public function delete($id){
        $user = User::find($id);
        if($user->delete()){
            return response()->json(['data'=>'Supprimé avec succès'],200);
        }else{
            return response()->json(['data'=>"Une erreur s'est produite"],500);
        }
    }

    //function containing message rules
    function getRules(){
        return [
            'name'=>'required',
            'classroom'=>'required',
            'bornAt'=>'required',
            'biography'=>'required',
            'phone'=>'required|min:9|max:12',
            'email'=>'required',
            'password'=>'required|min:8|max:16',
        ];
    }
}

