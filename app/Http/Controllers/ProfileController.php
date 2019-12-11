<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class ProfileController extends Controller
{
    public function index()
    {
        $usrs = Auth::user()->rs;
        return view('profile', ['usrs' => $usrs]);
    }

    public function changePassword(Request $request)
    {
        $user = User::find(Auth::id());
        
        if ($request->new_pswd == $request->con_pswd) {
            $user->password = Hash::make($request->new_pswd);
            $user->update();
            return redirect('/profil')->with('sukses', 'Penggantian kata sandi berhasil.');
        }
        
        return redirect('/profil')->with('error', 'Harap konfirmasi kata sandi yang baru dibuat dengan kata snadi yang sama dengan kata sandi yang baru Anda buat.');
    }
}
