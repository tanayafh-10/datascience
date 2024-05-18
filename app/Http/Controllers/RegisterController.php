<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function daftar()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => "required",
            'email_reg' => "required|email",
            'password_reg' => "required|min:3|max:16",
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email_reg;
        $user->password = Hash::make($request->password_reg);
        $user->save();

        // Kirim email verifikasi ke alamat email pengguna
        // $verificationUrl = route('verify', ['user' => $user]);
        // Mail::send('email.verify', ['verificationUrl' => $verificationUrl], function ($message) use ($user) {
        //     $message->to($user->email);
        //     $message->subject('Verifikasi Akun');
        // });

        return redirect('/login')->with('success', 'Registrasi Berhasil. Silahkan cek email Anda untuk melakukan verifikasi.');
    }
}
