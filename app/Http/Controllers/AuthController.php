<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email|max:50',
            'password' => 'required|max:50',
        ]);
        if(Auth::attempt($request->only('email', 'password'))){
            if(Auth::user()->role =='user') return redirect('/user');
            return redirect('/dashboard');
        }
        return back()->with('failed', 'Email atau Password salah');
        // dd($request->all());
    }

    public function logout(){
        Auth::logout(Auth::user());
        return redirect('/login');
    }

    public function register(Request $request){
        $request->validate([
            'email' => 'required|email|max:50',
            'password' => 'required|max:50|min:8',
            'confirm_password' => 'required|max:50|min:8|same:password',
        ]);
        dd($request->all());
    }
}
