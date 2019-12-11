<?php

namespace App\Imports;

use App\Rko;
use Maatwebsite\Excel\Concerns\ToModel;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RKOImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $rko = new Rko([
            'med_name' => $row[0],
            'unit'     => $row[1],
            'price'    => $row[2],
            'stock'    => $row[3],
            'use_avg'  => $row[4]
        ]);

        $rko->save();

        DB::insert('insert into rko_user (user_id, rko_id, periode1, periode2) values (?, ?, ?, ?)', [Auth::user()->id, $rko->id, $row[5], $row[6]]);

        return;
    }
}
