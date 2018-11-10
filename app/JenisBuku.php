<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisBuku extends Model
{
 	protected $table='jenis_bukus';
 	protected $fillable = ['jenis'];

 	public function Buku()
 	   {
 	   		return $this->hasMany('App\Buku','id_jenis');
 	   }   
}
