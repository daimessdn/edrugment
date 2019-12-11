<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Rs extends Model
{
    protected $table = 'hospitals';
    protected $fillable = ['nama_rs', 'alamat', 'kelurahan', 'kecamatan', 'kota', 'provinsi'];

    public function user()
    {
        return $this->belongsToMany(User::class);
    }
}
