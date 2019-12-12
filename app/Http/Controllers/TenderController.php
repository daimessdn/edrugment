<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Rs;
use App\Rko;

class TenderController extends Controller
{
    public function index()
    {
        $rs = Rs::all();

        return view('tender', ['rs' => $rs]);
    }

    public function detail($id)
    {
        $rs = Rs::find($id);
        $data_rko = Rs::find($id)->user[0]->rko;

        return view('tender_detail')->with('rs', $rs)->with('data_rko', $data_rko);
    }

    public function book($rsid, $rkoid)
    {
        $rs = Rs::find($rsid);
        $rko = Rko::find($rkoid);
        $user = Auth::id();

        DB::insert('insert into tender (rko_id, rs_id, user_id) value (?, ?, ?)', [$rko->id, $rs->id, $user]);
        DB::update('update rko_user set produced = 1 where rko_id = ? and submitted = 2', [$rko->id]);

        return back()->with('sukses', 'Pesanan '.$rko->med_name.' oleh '.$rs->nama_rs.' berhasil diambil pesanannya. Silahkan cek di laman "Pengolahan Obat".');
    }
}
