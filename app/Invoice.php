<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoice';

    public function rko() {
        return $this->hasMany(\App\Rko::class);
    }

    public function rs() {
        return $this->belongsTo(\App\Rs::class);
    }
}
