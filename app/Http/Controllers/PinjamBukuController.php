<?php

namespace App\Http\Controllers;

use App\PinjamBuku;
use App\Buku;
use App\Anggota;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\DataTables;
class PinjamBukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getedit($id)
    {
        $pinjam = PinjamBuku::find($id);
        $data['anggota']=$pinjam->Anggota->nama;
        $data['buku']=$pinjam->Buku->judul;
        $data['tglpinjam']=$pinjam->tanggal_pinjam;
        $data['tglhrskbl']=$pinjam->tglhrskbl;
        return json_encode($data);
    }
     public function jsonpinjam2()
    {
        $pinjam = PinjamBuku::where('tglkbl','=',null)->get();
        return Datatables::of($pinjam)
        ->addColumn('buku', function($pinjam){
            return $pinjam->Buku->judul;
        })
        ->addColumn('anggota', function($pinjam){
            return $pinjam->Anggota->nama;
        })
        ->addColumn('action', function($pinjam){
            return '<a href="#" class="btn btn-xs btn-primary edit" data-id="'.$pinjam->id.'">
            <i class="glyphicon glyphicon-edit"></i> Edit</a>';

            })
        ->rawColumns(['action','buku','anggota'])->make(true);
    }

    public function jsonpinjam3()
    {
        $pinjam = PinjamBuku::where('tglkbl','!=',null)->get();
        return Datatables::of($pinjam)
        ->addColumn('buku', function($pinjam){
            return $pinjam->Buku->judul;
        })
        ->addColumn('anggota', function($pinjam){
            return $pinjam->Anggota->nama;
        })
        ->addColumn('action', function($pinjam){
            return '<a href="#" class="btn btn-xs btn-primary edit" data-id="'.$pinjam->id.'">
            <i class="glyphicon glyphicon-edit"></i> Edit</a>';

            })
        ->rawColumns(['action','buku','anggota'])->make(true);
    }

    public function index()
    {
        $anggota = Anggota::all();
        $buku = Buku::all();

        return view('PinjamBuku.index',compact('anggota','buku'));
    }

    public function index2()
    {
        $anggota = Anggota::all();
        $buku = Buku::all();
        $pinjam = PinjamBuku::all();
        return view('PinjamBuku.index2',compact('anggota','buku','pinjam'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nopinjam' => 'required|unique:pinjam_bukus,nopinjam',
            'id_anggota' => 'required',
            'id_buku' => 'required',
            'tglhrskbl' => 'required',
        ],[
            'nopinjam.required' => ':Attribute  Tidak Boleh Kosong',
            'nopinjam.unique' => ':Attribute  Sudah Terpakai',
            'id_buku.required' => ':Attribute  Tidak Boleh Kosong',
            'id_anggota.required' => ':Attribute  Tidak Boleh Kosong',
            'tglhrskbl.required' => ':Attribute  Tidak Boleh Kosong',
        ]);
        $data = new PinjamBuku;
        $data->nopinjam = $request->nopinjam;
        $data->id_buku = $request->id_buku;
        $data->tanggal_pinjam = $request->tanggal_pinjam;
        $data->id_anggota = $request->id_anggota;
        $data->tglhrskbl = $request->tglhrskbl;
        $data->tglkbl = $request->tglkbl;
        $data->save();
        return response()->json(['success'=>true]);
    }

    public function store2(Request $request)
    {
        $this->validate($request, [
            'nopinjam' => 'required',
            'id_buku' => 'required',
            'tglhrskbl' => 'required',
        ],[
            'nopinjam.required' => ':Attribute  Tidak Boleh Kosong',
            'id_buku.required' => ':Attribute  Tidak Boleh Kosong',
            'tglhrskbl.required' => ':Attribute  Tidak Boleh Kosong',
        ]);
        $data = new PinjamBuku;
        $karbon = Carbon::now();
        $data->nopinjam = $request->nopinjam;
        $data->id_buku = $request->id_buku;
        $data->tanggal_pinjam = $request->tanggal_pinjam;
        $data->id_anggota = $request->id_anggota;
        $data->tglhrskbl = Carbon::now()->addDays(2)->format('Y-m-d');
        $data->tglkbl = $request->tglkbl;
        if($data->tglkbl > $data->tglhrskbl){
        $tanggal= date('d',strtotime($data->tglkbl));
        $tanggalbalik= date('d',strtotime($data->tglhrskbl));
        $bayar= $tanggal - $tanggalbalik;
        $data->denda= 2000;
        $data->denda = $data->denda*$bayar;
        }
        $data->save();
        return response()->json(['success'=>true]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PinjamBuku  $pinjamBuku
     * @return \Illuminate\Http\Response
     */
    public function show(PinjamBuku $pinjamBuku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PinjamBuku  $pinjamBuku
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pinjam = PinjamBuku::findOrfail($id);
        return $pinjam;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PinjamBuku  $pinjamBuku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'nopinjam' => 'required|unique:pinjam_bukus,nopinjam',
            'id_anggota' => 'required',
            'id_buku' => 'required',
            'tglhrskbl' => 'required',
        ],[
            'nopinjam.required' => ':Attribute  Tidak Boleh Kosong',
            'id_buku.required' => ':Attribute  Tidak Boleh Kosong',
            'id_anggota.required' => ':Attribute  Tidak Boleh Kosong',
            'tglhrskbl.required' => ':Attribute  Tidak Boleh Kosong',
        ]);
        $data = PinjamBuku::findOrfail($id);
        $data->nopinjam = $request->nopinjam;
        $data->id_buku = $request->id_buku;
        $data->id_anggota = $request->id_anggota;
        $data->tglhrskbl = $request->tglhrskbl;
        $data->tanggal_pinjam = $request->tanggal_pinjam;
        $data->save();
        return response()->json(['success'=>true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PinjamBuku  $pinjamBuku
     * @return \Illuminate\Http\Response
     */
    public function destroy(PinjamBuku $pinjamBuku)
    {
        //
    }
}
