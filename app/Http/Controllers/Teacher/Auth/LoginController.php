<?php

namespace App\Http\Controllers\Teacher\Auth;

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
        return view('teacher_panel.auth.teacher_login');
    }
    public function login(Request $request)
    {
        // dd($request->all());
        if (Auth::guard('teachers_web')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('teacher.show_exam_list');
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
        $this->middleware('teacher.guest')->except('logout');
    }
    public function logout(Request $request)
    {
        $this->guard('teachers_web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('teacher.login');
    }
}