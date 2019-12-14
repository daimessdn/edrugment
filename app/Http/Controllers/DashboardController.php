<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Invoice;
use App\Messages;
use App\Rko;
use App\Rs;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $messages = Messages::all()->where('role_id', '=', $user->roleid)->where('rs_id', '=', $user->rs_id)->where('dismissed', '=', 0);
        $count = count($messages);

        return view('pages.dashboard', ['messages' => $messages, 'count' => $count]);
    }

    public function dismiss($id)
    {
        $messages = Messages::find($id);
        
        DB::update('update messages set dismissed = 1 where id = ?', [$id]);

        return back();
    }
}
