<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\UserExport;

use Illuminate\Support\Facades\Hash;

use Maatwebsite\Excel\Facades\Excel;

class OtherController extends Controller
{
    public function index()
    {
        $user = \App\User::all();

        return view('new_user')->with('users', $user);
    }

    public function registerNewUser(Request $request)
    {
        $user = new \App\User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make('12345678');
        $user->roleid = $request->roleid;

        $user->save();

        return redirect('users')->with('sukses', 'Pembuatan sukses berhasil.
                                                  Anda dapat login dengan <strong>email : '.$user->email.'</strong>
                                                  dan password awal: 12345678');
    }
   
    public function getAllUsers()
    {
        return Excel::download(new UserExport, 'simbat-users.xlsx');
    }
}
