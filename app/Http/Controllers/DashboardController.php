<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $data_rko = Auth::user()->rko;
        return view('pages.dashboard', ['data_rko' => $data_rko]);
    }
}
