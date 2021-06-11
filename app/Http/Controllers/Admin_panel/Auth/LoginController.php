<?php

namespace App\Http\Controllers\Admin_panel\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    public function showLoginForm()
    {
        return view('admin_panel.admin_login');
    }
    public function username()
    {
        return 'user_name';
    }
    public function login(Request $request)
    {
        if (Auth::guard('admins_web')->attempt(['user_name' => $request->user_name, 'password' => $request->password])) {
            return redirect()->route('admin.index');
        }
        $request->session()->flash('error', 'login failed!');
        return redirect()->back();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin.guest')->except('logout');
    }
    public function logout(Request $request)
    {
        $this->guard('admins_web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}