<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
   protected $table = 'bukus';
   protected $fillable = ['id_jenis','judul','pengarang','isbn','tahun_terbit','penerbit','tersedia'];

   public function Jenis()
   {
   	 return $this->belongsTo('App\JenisBuku','id_jenis');
   }

   public function PinjamBuku()
   {
   		return $this->hasMany('App\PinjamBuku','id_buku');
   }

}
