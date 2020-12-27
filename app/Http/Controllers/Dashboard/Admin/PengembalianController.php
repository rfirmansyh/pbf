<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Pengembalian;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.modules.admin.pengembalians.index');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pengembalian  $pengembalian
     * @return \Illuminate\Http\Response
     */
    public function show(Pengembalian $pengembalian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pengembalian  $pengembalian
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengembalian $pengembalian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pengembalian  $pengembalian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengembalian $pengembalian)
    {
        //
    }

    public function deletewhere(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'id'        => ['required', 'array', 'min:1']
        ]);

        if ($validator->fails()) {
            \Session::flash('alert-type', 'danger'); 
            \Session::flash('alert-message', 'Tidak Bisa Hapus, tidak ada baris yang dipilih!'); 

            return redirect()->route('dashboard.admin.pengembalians.index');
        }
        $ids = $request->id;
        $query = "id = $ids[0]";
        if (count($ids) > 1) {
            for ($i=1; $i < count($ids); $i++) { 
                $query .= " or id = $ids[$i]";
            }
        }
        Pengembalian::whereRaw($query)->delete();

        \Session::flash('alert-type', 'success'); 
        \Session::flash('alert-message', 'Data Pengembalian Berhasil Dihapus!'); 
        return redirect()->route('dashboard.admin.pengembalians.index');
    }
}
