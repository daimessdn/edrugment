<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    // login
    public function signin()
    {
        return view('auths.signin');
    }

    public function postsignin(Request $request)
    {
        // dd($request->all());
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('/dashboard')->with('sukses', 'Selamat datang di Sistem Manajemen Obat (SIMBAT), '.Auth::user()->name.'.');
        }
        
        return redirect('signin')->with('error', 'Kombinasi email dan/atau kata sandi tidak tepat. Silahkan masukkan email dan kata sandi dengan benar.');
    }

    public function signout()
    {
        Auth::logout();
        return redirect('/signin')->with('sukses', 'Anda sudah log-out. Silahkan masuk kembali.');
    }
}


