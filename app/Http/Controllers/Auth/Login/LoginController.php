<?php

namespace App\Http\Controllers\Auth\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    //
    // use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home'; //仮ですdashboardのURL確定させたら変更

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectPath()
    {
        return '/login';
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->only('email', 'password');
            if (Auth::attempt($data)) {
                return redirect('/home');
            }
        }
        return view("auth.login");
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
