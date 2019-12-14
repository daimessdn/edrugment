<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rko extends Model
{
    // akses table rko
    protected $table = 'rko';
    protected $fillable = ['med_name', 'unit', 'price', 'stock', 'use_avg', 'periode1', 'periode2'];

    public function rs()
    {
        return $this->belongsTo(\App\Rs::class);
    }
}
