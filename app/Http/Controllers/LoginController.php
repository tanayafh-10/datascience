<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function login_action(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], 
            [
                'email.required' => 'Email wajib Diisi',
                'password.required' => 'Password wajib Diisi',

            ]);

        $infologin =[
            'email' => $request->email,
            'password' => $request->password,
        ];
        
        if (Auth::attempt($infologin)) {
            return match (Auth::user()->role) {
                'admin' => redirect('dashboard'),
                'user' => redirect('home'),
            };
        }

        return redirect('login')->with('failed', 'Username Atau Password Yang Dimasukkan Tidak Sesuai');
    }  

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
