<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ApplicantController extends Controller
{
    public function __construct()
    {
        
        $this->middleware('applicant_check');
        
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $parameter = Input::get('filter');
        
        if ($parameter == "1") {
            $user = Auth::user();
            
            $data = $user->ownerable->jobs;
            
            
            return response()->json($data, 200);
        } elseif ($parameter == "2") {
            
            $data = Job::whereDoesnthave('applicants', function($q)
            {
                $q->where('applicants.id', '=', 1);
            })->get();
            
            return response()->json($data);
            
        } else {
            return response()->json("no user");
        }
        
        
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {   
    
        $user = Auth::user();
        $applicant = $user->ownerable;
        $data = $user->ownerable->jobs()->where('job_id',$id)->where('applicant_id',$user->id)->first();
        if(!$data){
            
            $applicant->jobs()->attach($id);

        }else{

            return response()->json(["Already applied"]);

        }
        
        
        
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}