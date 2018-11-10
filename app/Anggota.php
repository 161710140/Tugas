<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table ='anggotas';
    protected $fillable =['no_anggota','nama','alamat','kota','no_telp'];

    public function Pinjam()
    {
    	return hasMany('App\PinjamBuku','id_anggota');
    }
}
