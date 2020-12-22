<?php

namespace App\Http\Controllers\Dashboard\Mitra;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProductiontypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productionTypes = \App\ProductionType::where('user_id', \Auth::user()->id)->paginate(5);
        return view('dashboard.modules.mitra.productiontypes.index')
                ->withProductionTypes($productionTypes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.modules.mitra.productiontypes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productionTypes =  new \App\ProductionType;
        $productionTypes->name = $request->name;
        $productionTypes->description = $request->description;
        $productionTypes->created_at = Carbon::now();
        $productionTypes->save();

        \Session::flash('alert-type', 'success'); 
        \Session::flash('alert-message', 'Data Produksi tipe baru Berhasil Ditambahkan!'); 
        return redirect()->route('dashboard.mitra.productiontypes.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productionType = \App\ProductionType::find($id);
        return view('dashboard.modules.mitra.productiontypes.edit')
                ->withProductionType($productionType);
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
        $productionTypes = \App\ProductionType::findOrFail($id);
        $productionTypes->name = $request->name;
        $productionTypes->description = $request->description;
        $productionTypes->updated_at = Carbon::now();
        $productionTypes->save();

        \Session::flash('alert-type', 'success'); 
        \Session::flash('alert-message', 'Data Produksi tipe baru Berhasil Diubah!'); 
        return redirect()->route('dashboard.mitra.productiontypes.edit', $id);
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
