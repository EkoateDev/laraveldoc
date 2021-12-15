<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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

    protected function authenticated($request, $user)
    {
        if ($user->hasRole('Admin')) {
            return redirect()->route('admindashboard')->with('success', 'Admin! You are logged in');
        } elseif ($user->hasRole('Regular')) {
            return redirect()->route('regulardashboard')->with('success', 'User! You are logged in');
        } else {
            return redirect()->route('login');
        }
    }

    // protected $redirectTo;


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    public function showLoginForm()
    {
        return view('auth.login')
            ->with('currentpage', 'login');
    }
}
