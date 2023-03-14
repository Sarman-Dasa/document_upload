<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'                  =>  'required|alpha_dash',
            'email'                 =>  'required|email|unique:users',
            'password'              =>  'required|digits:8',
            'password_confirmation' =>  'required|same:password'
        ]);
        
        $user = User::create($request->only(['name','email'])
        +[
            'password'  =>  Hash::make($request->password),
        ]);
        return redirect()->route('success.msg')->with('success',"Registration SuccessFully");
    }

    public function login()
    {
        return view('auth.login');
    }

    public function isValidUser(Request $request)
    {

        $request->validate([
            'email'     => 'required|email',
            'password'  => 'required'
        ]);
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect()->route("home");
        } else {
            return redirect()->route('error.msg')->with('error', 'Invalid Email address or Password');
        }
    }

}
