<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Invoice;
use App\User;
use App\Rko;

class Rs extends Model
{
    protected $table = 'hospitals';
    protected $fillable = ['nama_rs', 'alamat', 'kelurahan', 'kecamatan', 'kota', 'provinsi'];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function rko()
    {
        return $this->hasMany(Rko::class);
    }

    public function invoice()
    {
        return $this->hasMany(Invoice::class);
    }
}
