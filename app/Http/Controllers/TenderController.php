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
}
