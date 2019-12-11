<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $usrs = Auth::user()->rs;
        return view('profile', ['usrs' => $usrs]);
    }
}
