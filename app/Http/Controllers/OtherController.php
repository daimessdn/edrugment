<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\UserExport;

use Maatwebsite\Excel\Facades\Excel;

class OtherController extends Controller
{
    public function index()
    {
        $user = \App\User::all();

        return view('new_user')->with('users', $user);
    }
   
    public function getAllUsers()
    {
        return Excel::download(new UserExport, 'simbat-users.xlsx');
    }
}
