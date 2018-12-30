<?php

namespace App\Http\Controllers;
use App\User;
use Validator;
use App\Applicant;
use App\Recruiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register_recuiter(Request $request){

        $validatedData = $request->validate([
            'email' => 'required|string|email|unique:users',
            'password' => 'required',
            'name'=>'required|string'
        ]);

        $recruiter = Recruiter::create([
            
            'name'=>$request->name
        ]);

        $user =  User::create([
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'ownerable_type'=>"recruiter",
            'ownerable_id'=> $recruiter->id
        ]);

        

        return response()->json([
            'message' => 'Recruiter profile created'
        ]);
    } 


    public function register_applicant(Request $request){

        $validatedData = $request->validate([
            'email' => 'required|string|email|unique:users',
            'password' => 'required',
            'name'=>'required|string',
            'percentage'=>'required',
            'experience'=>'required',
            'phonenumber'=>'required'

        ]);
        

        $applicant = Applicant::create([
           
            'name'=>$request->name,
            'percentage'=>$request->percentage,
            'experience'=>$request->experience,
            'phonenumber'=>$request->phonenumber
        ]);

        $user =  User::create([
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'ownerable_type'=>"applicant",
            'ownerable_id' => $applicant->id
        ]);

       

        return response()->json([
            'message' => 'Applicant profile created'
        ]);
    }


    public function login(Request $request){

        $request->validate([
            'email' => 'required|string|email'
        ]);


        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            $success['role'] = $user->ownerable_id; 
            return response()->json(['success' => $success,'user'=>$user->ownerable_type],200);    
        } else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 

    }
    public function details() 
    { 
        $user = Auth::user(); 
        return response()->json(['success' => $user->ownerable], 200); 
    } 


}
