<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PinjamBuku extends Model
{
    protected $table='pinjam_bukus';
    protected $fillable=['nopinjam','id_anggota','id_buku','tanggal_pinjam','tglhrskbl'];

    public function Buku()
    {
    	return $this->belongsTo('App\Buku','id_buku');
    }

    public function Anggota()
    {
    	return $this->belongsTo('App\Anggota','id_anggota');
    }
}
