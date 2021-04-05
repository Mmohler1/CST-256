<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use Closure;

class MySecurityMiddleWare
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
        //Step 1: You can use the following to get the route URI $request-> or
        // can also use the $request->is();
        $path = $request->path();
        Log::info("Entering My Security Middle in handle() at path: ". $path);
        //Step 2: Run the business rules that check for the URI's you do not need to secure
        $secureCheck = true;
        if ($request-> is('/') || $request-> is('login') || $request-> is('logout') || $request-> is('register')|| $request-> is('suspended')
            || $request-> is('userrest') || $request-> is('userrest/*')|| $request-> is('jobsrest') || $request-> is('jobsrest/*')
            || $request-> is('efoliorest') || $request-> is('efoliorest/*'))
        {
            $secureCheck = false;
        }
     
        Log::info($secureCheck ? "Security Middleware in handle() .... Needs Security " :
            "Security MiddleWare in handle()....No Security Required");
         
        // Step 3 If entering a secure URI with no Security token then do a redirect ot the root URI or Login page
        Log::info("This is the session in the Security middleware: " . session()->get('key'));

        
        //If the session is good then let the user go to thier desired page.
        if (Auth::check())
        {
            Log::info("Session sucessfully found");
            return $next($request);
        }
       else if($secureCheck) //If session is not good and not a page one needs a session, then redirect to login.
        {
            Log::info("Leaving My Security MiddleWare in handle() doing a redirect back to login");
            return redirect('/login');
        }
        
        
        return $next($request);
    }
}
