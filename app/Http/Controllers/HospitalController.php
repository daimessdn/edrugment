<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Rs;
use App\Rko;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HospitalController extends Controller
{
    public function index()
    {
        $rs = Rs::all();

        return view('rs', ['rs' => $rs]);
    }

    public function detail($id)
    {
        $rs = Rs::find($id);
        $data_rko = Rs::find($id)->user[0]->rko;

        return view('rs_detail')->with('rs', $rs)->with('data_rko', $data_rko);
    }

    public function approve($id)
    {
        $rs = Rs::find($id);
        $userid = Rs::find($id)->user[0]->id;
        $data_rko = Rs::find($id)->user[0]->rko;

        DB::update('update rko_user set approved = 1 where user_id = ?', [$userid]);
        DB::update('update rko_user set submitted = 2 where user_id = ?', [$userid]);

        return back()->with('rs', $rs)->with('data_rko', $data_rko)->with('sukses', 'Permintaan RKO berhasil diproses.');
    }

    public function decline($id)
    {
        $rs = Rs::find($id);
        $userid = Rs::find($id)->user[0]->id;
        $data_rko = Rs::find($id)->user[0]->rko;

        DB::update('update rko_user set approved = 2 where user_id = ?', [$userid]);
        DB::update('update rko_user set submitted = 2 where user_id = ?', [$userid]);

        return back()->with('rs', $rs)->with('data_rko', $data_rko)->with('sukses', 'Permintaan RKO berhasil diproses.');
    }
}
