<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\Business\SecurityService;
use App\User;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    
    
    
    //Date 2/7/21
    //Overrides the other authentication to check for suspensions.
    protected function authenticated(Request $request, $user)
    {
        $email = $request->input('email');
        
        
        $securityser = new SecurityService();
        
        
        if($securityser ->checkWhatRole($email)=="suspended")
        {
            
            
            //Copy paste from AuthenticateUser logout, but with redirect to /login instead.
            $this->guard()->logout();
            $request->session()->invalidate();
            return view('/suspended');
        }
        
    }
}
