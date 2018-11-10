<?php

namespace App\Http\Controllers;

use App\JenisBuku;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\DataTables;

class JenisBukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function jsonjenis()
    {
         $jenis = JenisBuku::all();
        return Datatables::of($jenis)
        ->addColumn('action', function($jenis){
            return '<a href="#" class="btn btn-xs btn-primary edit" data-id="'.$jenis->id.'">
            <i class="glyphicon glyphicon-edit"></i> Edit</a>&nbsp;
            <a href="#" class="btn btn-xs btn-danger delete" id="'.$jenis->id.'">
            <i class="glyphicon glyphicon-remove"></i> Delete</a>';

            })
        ->rawColumns(['action'])->make(true);
    }

    public function index()
    {
        return view('Jenis.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'jenis' => 'required',
        ],[
            'jenis.required' => 'jenis Tidak Boleh Kosong',
        ]);
        $data = new JenisBuku;
        $data->jenis = $request->jenis;
        $data->save();
        return response()->json(['success'=>true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JenisBuku  $jenisBuku
     * @return \Illuminate\Http\Response
     */
    public function show(JenisBuku $jenisBuku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JenisBuku  $jenisBuku
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jenis = JenisBuku::findOrfail($id);
        return $jenis;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JenisBuku  $jenisBuku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'jenis' => 'required',
        ],[
            'jenis.required' => ':Attribute Tidak Boleh Kosong',
        ]);
        $data = JenisBuku::findOrfail($id);
        $data->jenis = $request->jenis;
        $data->save();
        return response()->json(['success'=>true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JenisBuku  $jenisBuku
     * @return \Illuminate\Http\Response
     */
    public function removedata(Request $request)
    {
        $jenis = JenisBuku::find($request->input('id'));
        if($jenis->delete())
        {
            echo 'Data Deleted';
        }
    }

    public function destroy(JenisBuku $jenisBuku)
    {
        //
    }
}
