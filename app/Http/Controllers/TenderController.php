<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Rs;
use App\Rko;
use App\Invoice;

class TenderController extends Controller
{
    public function index()
    {
        $invoices = Invoice::all();
        $count = count($invoices->where('stage', '=', '2'));

        return view('tender')->with('invoices', $invoices)->with('count', $count);
    }

    public function book($id)
    {
        $inv = Invoice::find($id);
        $rko = $inv->rko;
        $user = Auth::id();

        DB::update('update rko set produced = 1 where invoice_id = ?', [$inv->id]);
        DB::update('update invoice set stage = 3 where id = ?', [$inv->id]);

        return back()->with('sukses', 'Pesanan dengan nomor invoice '.$inv->id.' oleh '.$inv->rs->nama_rs.' berhasil diambil pesanannya. Silahkan cek di laman "Pengolahan Obat".');
    }

    public function manage()
    {
        $rs = Rko::all();

        return view('pengolahan')->with('rs', $rs);
    }
}
