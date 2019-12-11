<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rko extends Model
{
    // akses table rko
    protected $table = 'rko';
    protected $fillable = ['med_name', 'unit', 'price', 'stock', 'use_avg'];

    public function user()
    {
        return $this->belongsToMany(\App\User::class)->withPivot(['submitted','approved', 'periode1', 'periode2']);
    }
}
