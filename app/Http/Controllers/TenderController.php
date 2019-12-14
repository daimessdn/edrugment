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
        DB::update('update invoice set tender_id = ? where id = ?', [Auth::id(), $inv->id]);
        DB::update('update invoice set stage = 3 where id = ?', [$inv->id]);

        return back()->with('sukses', 'Pesanan dengan nomor invoice '.$inv->id.' oleh '.$inv->rs->nama_rs.' berhasil diambil pesanannya. Silahkan cek di laman "Pengolahan Obat".');
    }

    public function manage()
    {
        $invoices = \App\Invoice::all()->where('tender_id', '=', Auth::id())->where('stage', '=', 3);
        $progress = \App\Invoice::all()->where('tender_id', '=', Auth::id())->where('stage', '=', 4);
        $count = count($invoices);
        $progcount = count($progress);

        return view('pengolahan')->with('invoices', $invoices)->with('progress', $progress)->with('count', [$count, $progcount]);
    }

    public function addQuantity($inv_id, $rko_id, Request $request)
    {
        $inv = Invoice::find($inv_id);
        $rko = Rko::find($rko_id);
        $user = Auth::id();

        DB::update('update rko set quantity = ? where invoice_id = ? and id = ?', [$request->quantity, $inv->id, $rko->id]);

        return redirect('/manage')->with('sukses', $rko->med_name.' ['.$inv->rs->nama_rs.'] berhasil diset jumlah produksi.');
    }

    public function produce($inv_id, Request $request)
    {
        $inv = Invoice::find($inv_id);

        $date = date('Y-m-d H:i:s');

        DB::update('update invoice set estimated = ? where id = ?', [$request->estimated, $inv->id]);
        DB::update('update invoice set stage = 4 where id = ?', [$inv->id]);
        DB::update('update invoice set started_at = ? where id = ?', [$date ,$inv->id]);
        DB::update('update invoice set finished_at = date_add(?, interval ? day) where id = ?', [$date, $request->estimated, $inv->id]);

        return redirect('/manage')->with('sukses', 'Produksi sudah dimulai untuk invoice #'.$inv->id.' ['.$inv->rs->nama_rs.'] berhasil diset jumlah produksi.');
    }
}
