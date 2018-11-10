<?php

namespace App\Http\Controllers;

use App\Anggota;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\DataTables;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function jsonanggota()
    {
         $anggota = Anggota::all();
        return Datatables::of($anggota)
        ->addColumn('action', function($anggota){
            return '<a href="#" class="btn btn-xs btn-primary edit" data-id="'.$anggota->id.'">
            <i class="glyphicon glyphicon-edit"></i> Edit</a>&nbsp;
            <a href="#" class="btn btn-xs btn-danger delete" id="'.$anggota->id.'">
            <i class="glyphicon glyphicon-remove"></i> Delete</a>';

            })
        ->rawColumns(['action'])->make(true);
    }

    public function index()
    {
        return view('Anggota.index');
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
            'no_anggota' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'no_telp' => 'required|numeric|min:12',
        ],[
            'no_anggota.required' => 'no_anggota Tidak Boleh Kosong',
            'nama.required' => 'nama Tidak Boleh Kosong',
            'alamat.required' => 'alamat Tidak Boleh Kosong',
            'kota.required' => 'kota Tidak Boleh Kosong',
            'no_telp.required' => 'no telp Tidak Boleh Kosong',
            'no_telp.max' => 'Tidak Boleh Melebihi 12 Angka',
        ]);
        $data = new Anggota;
        $data->no_anggota = $request->no_anggota;
        $data->nama = $request->nama;
        $data->alamat = $request->alamat;
        $data->kota = $request->kota;
        $data->no_telp = $request->no_telp;
        $data->save();
        return response()->json(['success'=>true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function show(Anggota $anggota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $anggota = Anggota::findOrFail($id);
        return $anggota;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
         $this->validate($request, [
            'no_anggota' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'no_telp' => 'required',
        ],[
            'no_anggota.required' => 'no_anggota Tidak Boleh Kosong',
            'nama.required' => 'nama Tidak Boleh Kosong',
            'alamat.required' => 'alamat Tidak Boleh Kosong',
            'kota.required' => 'kota Tidak Boleh Kosong',
            'no telp.required' => 'no telp Tidak Boleh Kosong',
        ]);
        $data = Anggota::findOrFail($id);
        $data->no_anggota = $request->no_anggota;
        $data->nama = $request->nama;
        $data->alamat = $request->alamat;
        $data->kota = $request->kota;
        $data->no_telp = $request->no_telp;
        $data->save();
        return response()->json(['success'=>true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */

    public function removedata(Request $request)
    {
        $anggota = Anggota::find($request->input('id'));
        if($anggota->delete())
        {
            echo 'Data Deleted';
        }
    }

    public function destroy(Anggota $anggota)
    {
        //
    }
}
