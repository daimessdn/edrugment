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
        $data_rko = $rs->rko()->where('submitted', '=', '1')->get();

        $datacount = count(DB::select('select * from rko where rs_id = ? and submitted = 1 and approved = 0', [$rs->id]));

        return view('rs_detail')->with('rs', $rs)->with('data_rko', $data_rko)->with('datacount', $datacount);
    }
}
