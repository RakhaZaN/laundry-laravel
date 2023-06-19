<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(): View
    {
        return view('register');
    }

    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            'phone' => 'required|string',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $validate['password'] = Hash::make($request->password);
        $register = User::create($validate);

        if ($register) {
            return redirect(route('auth.login'))->with('success', 'Berhasil mendaftar, silahkan melakukan login');
        }
        return back()->with('error', 'Ada kesalahan sistem, mohon coba beberapa saat lagi!')->withInput($request->except('password'));
    }

    public function login(): View
    {
        return view('login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => "required|email",
            'password' => "required"
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $role = Auth::user()->role;
            if ($role == 'admin') return redirect()->intended('/admin');
            else if ($role == 'kasir') return redirect()->intended('/kasir');
            else return redirect()->intended('/')->with('success', 'Selamat Datang, ' . Auth::user()->name);
        }
        return back()->with('error', 'Ada kesalahan sistem, mohon coba beberapa saat lagi!')->withInput($request->except('password'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
