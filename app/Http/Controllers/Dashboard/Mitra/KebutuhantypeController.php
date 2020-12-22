<?php

namespace App\Http\Controllers\Dashboard\Mitra;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class KebutuhantypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kebutuhanTypes = \App\KebutuhanType::where('user_id', \Auth::user()->id)
                            ->paginate(5);
        return view('dashboard.modules.mitra.kebutuhantypes.index')
                ->withKebutuhanTypes($kebutuhanTypes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.modules.mitra.kebutuhantypes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kebutuhanTypes =  new \App\Kebutuhantype;
        $kebutuhanTypes->name = $request->name;
        $kebutuhanTypes->unit = $request->unit;
        $kebutuhanTypes->description = $request->description;
        $kebutuhanTypes->created_at = Carbon::now();
        $kebutuhanTypes->save();

        \Session::flash('alert-type', 'success'); 
        \Session::flash('alert-message', 'Data Kebutuhan Produksi baru Berhasil Ditambahkan!'); 
        return redirect()->route('dashboard.mitra.kebutuhantypes.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kebutuhanType = \App\KebutuhanType::findOrFail($id);
        return view('dashboard.modules.mitra.kebutuhantypes.edit')
                ->withKebutuhanType($kebutuhanType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $kebutuhanType = \App\KebutuhanType::findOrFail($id);
        $kebutuhanType->name = $request->name;
        $kebutuhanType->unit = $request->unit;
        $kebutuhanType->description = $request->description;
        $kebutuhanType->updated_at = Carbon::now();
        $kebutuhanType->save();

        \Session::flash('alert-type', 'success'); 
        \Session::flash('alert-message', 'Data Kebutuhan Produksi baru Berhasil Diubah!'); 
        return redirect()->route('dashboard.mitra.kebutuhantypes.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
