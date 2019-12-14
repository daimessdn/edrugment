<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Rko;
use App\Rs;

use App\Imports\RKOImport;
use App\Exports\RKOExport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RkoController extends Controller
{
    // index
    public function index()
    {
        $data_rko = Auth::user()->rs->rko()->where('submitted', '=', 0)->get();

        $datacount = count(DB::select('select * from rko where rs_id = ? and submitted = 0', [Auth::user()->rs->id]));

        return view('rko')->with('data_rko', $data_rko)->with('datacount', $datacount);
    }

    // riwayat pengisian RKO
    public function history()
    {
        $invoices = Auth::user()->rs->invoice()->get();
        
        return view('history')->with('invoices', $invoices);
    }

    public function qr($id)
    {
        $inv_id = Auth::user()->rs->invoice()->where('id', '=', $id)->get();

        return view('images/qrcode.png');
    }

    // status RKO
    public function status()
    {
        $data_rko = Auth::user()->rs->rko()->get();

        $countsubmitted = count(DB::select('select * from rko where rs_id = ? and submitted = 1 and approved = 0', [Auth::user()->rs->id]));
        $countapproved = count(DB::select('select * from rko where rs_id = ? and submitted = 2 and approved = 1', [Auth::user()->rs->id]));
        $countdeclined = count(DB::select('select * from rko where rs_id = ? and submitted = 2 and approved = 2', [Auth::user()->rs->id]));

        return view('rko_status')->with('data_rko', $data_rko)->with('datacount', [$countsubmitted, $countapproved, $countdeclined]);
    }

    // submit data RKO
    public function create(Request $request)
    {
        // return "Data RKO disubmit";
        // return $request->all();
        // Rko::create($request->all());

        $rs_id = Auth::user()->rs[0]->id;

        $rko = new RKO;

        $rko->med_name = $request->med_name;
        $rko->unit = $request->unit;
        $rko->price = $request->price;
        $rko->stock = $request->stock;
        $rko->use_avg = $request->use_avg;
        $rko->periode1 = $request->periode1;
        $rko->periode2 = $request->periode2;

        $rko->save();

        DB::insert('insert into rko_rs (rs_id, rko_id) values (?, ?)', [$rs_id, $rko->id]);
        DB::insert('insert into rko_user (user_id, rko_id) values (?, ?)', [Auth::user()->id, $rko->id]);
        return redirect('\rko')->with('sukses', 'Data obat berhasil ditambahkan');
    }

    // edit data RKO
    public function edit ($id)
    {
        $rko = Rko::find($id);

        // dd($rko);
        return view('edit', ['rko' => $rko]);
    }
    

    // lagi-lagi edit data RKO
    public function update (Request $request, $id)
    {
        $rko = Rko::find($id);
        $rko->update($request->all());
        return redirect('\rko')->with('sukses', 'Data obat berhasil diedit');
    }

    // hapus data RKO
    public function delete ($id)
    {
        $rko = Rko::find($id);
        $rko->delete($rko);
        DB::delete('delete from rko_user where rko_id = ?', [$id]);
        DB::delete('delete from rko_rs where rko_id = ?', [$id]);
        return redirect('\rko')->with('sukses', 'Data obat berhasil dihapus');
    }

    // submit data RKO
    public function submit()
    {
        DB::insert('insert into invoice (rs_id, content) values (?, ?)', [Auth::user()->rs->id, json_encode(Auth::user()->rs->rko->where('submitted', '=', 0))]);
        
        $invoice = DB::table('invoice')->orderBy('id', 'desc')->first();

        DB::update('update rko set invoice_id = ? where rs_id = ? and submitted = 0 and invoice_id = 0', [$invoice->id, Auth::user()->rs->id]);
        
        \QrCode::size(1000)->format('png')->generate(json_encode(Auth::user()->rs->rko->where('submitted', '=', 0)), public_path('QR/'.$invoice->id.'.png'));
        
        DB::update('update rko set submitted = 1 where rs_id = ? and submitted = 0', [Auth::user()->rs->id]);

        return redirect('\rko')->with(
            'sukses',
            'Data RKO berhasil disubmit. Permintaan RKO Anda akan diproses oleh administrator untuk diverifikasi.
             Silahkan menuju laman "Status RKO" untuk melihat status RKO dan "Riwayat Rencana" untuk melihat invoice RKO yang telah dibuat.');
    }

    // EXPORT IMPORT data RKO
    // import data dari excel
    public function importExcel()
    {
        Excel::import(new RKOImport, request()->file('file'));
        return redirect('/rko')->with('sukses', 'Data obat berhasil ditambahkan melalui import excel');
    }

    public function exportExcel()
    {
        return Excel::download(new RKOExport, 'rko.xlsx');
    }
}
