<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\UserExport;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Facades\Excel;

class OtherController extends Controller
{
    public function index()
    {
        $user = \App\User::all();

        return view('new_user')->with('users', $user);
    }

    public function process()
    {
        $invoices = \App\Invoice::all()->where('stage', '=', 1);
        $count = count($invoices);

        return view('process')->with('invoices', $invoices)->with('count', $count);
    }

    public function approve($id)
    {
        $inv = \App\Invoice::find($id);

        DB::update('update rko set submitted = 2 where invoice_id = ?', [$inv->id]);
        DB::update('update rko set approved = 1 where invoice_id = ?', [$inv->id]);
        DB::update('update invoice set stage = 2 where id = ?', [$inv->id]);
        
        return back()->with('inv', $inv)->with('sukses', 'Permintaan RKO berhasil diproses.');
    }

    public function decline($id)
    {
        $inv = \App\Invoice::find($id);

        DB::update('update rko set submitted = 2 where invoice_id = ?', [$inv->id]);
        DB::update('update rko set approved = 2 where invoice_id = ?', [$inv->id]);
        DB::update('update invoice set stage = 2 where id = ?', [$inv->id]);
        
        return back()->with('inv', $inv)->with('sukses', 'Permintaan RKO berhasil diproses.');
    }

    public function registerNewUser(Request $request)
    {
        $user = new \App\User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make('12345678');
        $user->roleid = $request->roleid;

        if ($user->roleid != -999) {
            $user->save();
    
            return redirect('users')->with('sukses', 'Pembuatan sukses berhasil.
                                                      Anda dapat login dengan email : '.$user->email.'
                                                      dan password awal: 12345678');
        }
        return redirect('users')->with('error', 'Role wajib dipilih.');
    }
   
    public function getAllUsers()
    {
        return Excel::download(new UserExport, 'simbat-users.xlsx');
    }
}
