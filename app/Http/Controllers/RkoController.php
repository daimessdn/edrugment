<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Rko;
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
        $data_rko = Auth::user()->rko;

        $datacount = count(DB::select('select * from rko_user where user_id = ? and submitted = 0', [Auth::id()]));

        return view('rko')->with('data_rko', $data_rko)->with('datacount', $datacount);
    }

    // status RKO
    public function status()
    {
        $data_rko = Auth::user()->rko;

        $countsubmitted = count(DB::select('select * from rko_user where user_id = ? and submitted <> 0 and approved = 0', [Auth::id()]));
        $countapproved = count(DB::select('select * from rko_user where user_id = ? and submitted = 2 and approved = 1', [Auth::id()]));
        $countdeclined = count(DB::select('select * from rko_user where user_id = ? and submitted = 2 and approved = 2', [Auth::id()]));

        return view('rko_status')->with('data_rko', $data_rko)->with('datacount', [$countsubmitted, $countapproved, $countdeclined]);
    }

    // submit data RKO
    public function create(Request $request)
    {
        // return "Data RKO disubmit";
        // return $request->all();
        // Rko::create($request->all());

        $rko = new RKO;

        $rko->med_name = $request->med_name;
        $rko->unit = $request->unit;
        $rko->price = $request->price;
        $rko->stock = $request->stock;
        $rko->use_avg = $request->use_avg;
        $rko->periode1 = $request->periode1;
        $rko->periode2 = $request->periode2;

        $rko->save();

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
        return redirect('\rko')->with('sukses', 'Data obat berhasil dihapus');
    }

    // submit data RKO
    public function submit()
    {
        DB::update('update rko_user set submitted = 1 where user_id = ? and submitted = 0', [Auth::user()->id]);
        
        return redirect('\rko')->with('sukses', 'Data RKO berhasil disubmit. Permintaan RKO Anda akan diproses oleh administrator untuk diverifikasi.');
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
