<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class AllController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function index()
    {
        return view('index');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/')->with('success', 'Anda berhasil logout!!');
    }

}
