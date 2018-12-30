<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecruiterController extends Controller
{

    public function __construct()
    {
        
        $this->middleware('recruiter_check');

        
    }
    public function create(Request $request ){

       $user = Auth::user(); 

       $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'salary'=>'required'  
        ]);

        $job = Job::create([
           
            'title'=>$request->title,
            'description'=>$request->description,
            'salary'=>$request->salary,
            'recruiter_id'=>$user->ownerable->id
        ]);

         return response()->json($job, 200);

    }
    public function index(){

        $user = Auth::user(); 
        $data = $user->ownerable->jobs;
        return response()->json($data, 200);
    }
    public function show($id){

        $user = Auth::user();
        $job = Job::find($id);

        if ($user->can('view', $job)) {            
            return response()->json("hello", 200);
         } else {
            echo 'Not Authorized.';
        }
    }
}
