<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\PasswordResetTokenn;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Hash;




class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:50',
            'password' => 'required|max:50',
        ]);
        if (Auth::attempt($request->only('email', 'password'))) {
            if (Auth::user()->role == 'user') return redirect('/user');
            return redirect('/dashboard');
        }
        return back()->with('failed', 'Email atau Password salah');
        // dd($request->all());
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|max:50|unique:users,email',
            'password' => 'required|min:8|max:50',
            'confirm_password' => 'required|same:password',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'status' => 'verify',
            'role' => 'user',
        ]);

        Auth::login($user);
        return redirect('/user');
    }

    public function google_redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function google_callback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();
        $user = User::whereEmail($googleUser->email)->first();
        if (!$user) {
            $user = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'password' => bcrypt(Str::random(20)), // WAJIB DI PROJECT KAMU
                'status' => 'verify',
                'role' => 'user',
            ]);
        }
        if ($user && $user->status == 'banned') {
            return redirect('/login')->with('failed', 'Akun anda telah dibekukan');
        }
        if ($user && $user->status == 'verify') {
            $user->update(['status' => 'active']);
        }
        Auth::login($user);
        if ($user->role == 'user') return redirect('/user');
        return redirect('/admin');
    }

    public function logout()
    {
        Auth::logout(Auth::user());
        return redirect('/login');
    }

    public function forgot_password()
    {
        return view('auth.forgot-password');
    }

    public function forgot_password_act(Request $request)
    {
        $customMessage = [
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'email.exists' => 'Email tidak terdaftar',
        ];
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ], $customMessage);

        $token = Str::random(60);
        PasswordResetTokenn::updateOrCreate(
            [
                'email' => $request->email
            ],
            [
                'email' => $request->email,
                'token' => $token,
                'created_at' => now(),

            ]
        );

        Mail::to($request->email)->send(new ResetPasswordMail($token));
        return redirect()->route('forgot-password')->with('success', 'Kami telah mengirimkan link rest password ke email');
    }

    public function validasi_forgot_password_act(Request $request){
        $customMessage = [
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password tidak valid',
        ];
        $request->validate([
            'password' => 'required|min:8'
        ], $customMessage);


        $token = PasswordResetTokenn::where('token', $request->token)->first();
        if (!$token) {
            return redirect()->route('login')->with('failed', 'Token tidak valid');

        }

        $user = User::where('email', $token->email)->first();

        if (!$user) {
            return redirect()->route('login')->with('failed', 'email tidak terdaftar');
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        $token->delete();
        return redirect()->route('login')->with('success', 'password berhasil direset');

    }

    public function validasi_forgot_password(Request $request, $token)
    {

        $getToken = PasswordResetTokenn::where('token', $token)->first();

        if (!$getToken) {
            return redirect()->route('login')->with('failed', 'Token tidak valid');

        }

            return view('auth.validasi-token', compact('token'));
        }
    }

