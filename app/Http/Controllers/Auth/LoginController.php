<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\Session;

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
    protected $redirectTo = '/profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticated(Request $request, $user){
        $request->session()->flash('flash_notification_login', 'Logged in successfully!');
        return redirect()->intended($this->redirectPath());
    }

    public function logout(Request $request){
        $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->flash('flash_notification_logout', 'Logget out successfully!');
        return redirect('/');
    }

    // public function showLoginForm(){
    //     if(!session()->has('url.intended')){
    //         session(['url.intended' => url()->previous()]);
    //     }
    //     return view('auth.login');    
    // }
}
