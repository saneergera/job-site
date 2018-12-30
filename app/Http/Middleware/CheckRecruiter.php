<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRecruiter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

       $user =Auth::user();
       $user_role= $user->ownerable_type;
       if($user_role == "recruiter"){
        return $next($request);
       }else{
        return response()->json("Unauthorized access"); 
       }

        
    }
}
