<?php

namespace App\Http\Controllers;

use App\Buku;
use App\JenisBuku;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\DataTables;
class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function jsonbuku($value='')
    {
        $buku = Buku::all();
        return Datatables::of($buku)
        ->addColumn('jenis', function($buku){
            return $buku->Jenis->jenis;
        })
        ->addColumn('action', function($buku){
            return '<a href="#" class="btn btn-xs btn-primary edit" data-id="'.$buku->id.'">
            <i class="glyphicon glyphicon-edit"></i> Edit</a>&nbsp;
            <a href="#" class="btn btn-xs btn-danger delete" id="'.$buku->id.'">
            <i class="glyphicon glyphicon-remove"></i> Delete</a>';

            })
        ->rawColumns(['action','jenis'])->make(true);
    }

    public function index()
    {
        $jenis=JenisBuku::all();
        return view('Buku.index',compact('jenis'));
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
            'judul' => 'required',
            'id_jenis' => 'required',
            'isbn' => 'required',
            'pengarang' => 'required',
            'tahun_terbit' => 'required|numeric',
            'penerbit' => 'required',
            'tersedia' => 'required',
        ],[
            'judul.required' => ':Attribute  Tidak Boleh Kosong',
            'isbn.required' => ':Attribute  Tidak Boleh Kosong',
            'id_jenis.required' => ':Attribute  Tidak Boleh Kosong',
            'pengarang.required' => ':Attribute  Tidak Boleh Kosong',
            'tahun_terbit.required' => ':Attribute Tidak Boleh Kosong',
            'tahun_terbit.numeric' => 'Isi :Attribute yang valid ',
            'penerbit.required' => ':Attribute  Tidak Boleh Kosong',
        ]);
        $data = new Buku;
        $data->judul = $request->judul;
        $data->isbn = $request->isbn;
        $data->id_jenis = $request->id_jenis;
        $data->pengarang = $request->pengarang;
        $data->tahun_terbit = $request->tahun_terbit;
        $data->penerbit = $request->penerbit;
        $data->tersedia = $request->tersedia;
        $data->save();
        return response()->json(['success'=>true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function show(Buku $buku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        return $buku;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'judul' => 'required',
            'id_jenis' => 'required',
            'pengarang' => 'required',
            'tahun_terbit' => 'required',
            'penerbit' => 'required',
            'tersedia' => 'required',
        ],[
            'judul.required' => 'judul Tidak Boleh Kosong',
            'id_jenis.required' => 'id_jenis Tidak Boleh Kosong',
            'pengarang.required' => 'pengarang Tidak Boleh Kosong',
            'tahun_terbit.required' => 'tahun_terbit Tidak Boleh Kosong',
            'penerbit.required' => 'no telp Tidak Boleh Kosong',
        ]);
        $data = Buku::findOrfail($id);
        $data->judul = $request->judul;
        $data->id_jenis = $request->id_jenis;
        $data->pengarang = $request->pengarang;
        $data->tahun_terbit = $request->tahun_terbit;
        $data->penerbit = $request->penerbit;
        $data->tersedia = $request->tersedia;
        $data->save();
        return response()->json(['success'=>true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Buku  $buku
     * @return \Illuminate\Http\Response
     */

    public function removedata(Request $request)
    {
        $buku = Buku::find($request->input('id'));
        if($buku->delete())
        {
            echo 'Data Deleted';
        }
    }

    public function destroy(Buku $buku)
    {
        //
    }
}
