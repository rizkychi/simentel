<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            //Login Success
            return redirect()->route('home');
        }
        return view('public.login');
    }

    public function doLogin(Request $request)
    {
        // input rules
        $rules = [
            'username'              => 'required|string',
            'password'              => 'required|string'
        ];
 
        // error messages
        $messages = [
            'username.required'     => 'Username wajib diisi',
            'username.string'       => 'Username tidak valid',
            'password.required'     => 'Password wajib diisi',
            'password.string'       => 'Password harus berupa string'
        ];
 
        // validate login info
        $validator = Validator::make($request->all(), $rules, $messages);
 
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
 
        // authenticate
        $data = [
            'username'  => $request->input('username'),
            'password'  => $request->input('password'),
        ];
 
        Auth::attempt($data);
 
        if (Auth::check()) {
            //Login Success
            return redirect()->route('home');
        } else {
            //Login Fail
            // Session::flash('error', 'username atau password salah');
            return back()->withErrors('username atau password salah')->withInput();
        }
    }

    public function doLogout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
