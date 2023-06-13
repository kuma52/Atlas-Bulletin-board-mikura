<?php

namespace App\Http\Controllers\Auth\Register;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Users\User;

class RegisterAddedController extends Controller
{
    //
    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    //createメソッド（createnewuserメソッド内で使う）
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    // registerページを表示
    public function register()
    {
        return view('auth.register');
    }

    public function createnewuser(RegisterRequest $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->input();
            $this->create($data);
        }
        return view('auth.added');
    }
}
