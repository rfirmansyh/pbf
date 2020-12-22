<?php

namespace App\Http\Controllers\Dashboard\Mitra;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kumbung;

class KumbungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $budidayas = \App\Budidaya::where('owned_by_uid', '=', \Auth::user()->id)->get();
        $budidayaSelected = \App\Budidaya::where('owned_by_uid', '=', \Auth::user()->id)->first();
        if ($request->select_budidaya_id) {
            $budidayaSelected = \App\Budidaya::where('owned_by_uid', '=', \Auth::user()->id)->find($request->select_budidaya_id);
        }
        $kumbungs = \App\Kumbung::where('budidaya_id', '=', $budidayaSelected->id)->paginate(4);
        return view('dashboard.modules.mitra.kumbungs.index')->with([
            'budidayas' => $budidayas,
            'budidayaSelected' => $budidayaSelected,
            'kumbungs' => $kumbungs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $budidayas = \App\Budidaya::where('owned_by_uid', '=', \Auth::user()->id)->get();
        $jamurs = \App\Jamur::all();
        return view('dashboard.modules.mitra.kumbungs.create')->with([
            'budidayas' => $budidayas,
            'jamurs' => $jamurs
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = \Validator::make($request->all(), [
            'name'                  => 'required|min:5|max:191',
            'large'                 => 'required|numeric|min:4',
            'status'                => 'required',
            'jamur_id'              => 'required',
            'budidaya_id'           => 'required'
        ])->validate();

        $kumbung = new Kumbung;
        if ($request->file('photo')) {
            $file = $request->file('photo')->store('photo/kumbung', 'public');
            $kumbung->photo = $file;
        }
        $kumbung->name = $request->name;
        $kumbung->large = $request->large;
        $kumbung->status = $request->status;
        $kumbung->jamur_id = $request->jamur_id;
        $kumbung->budidaya_id = $request->budidaya_id;
        $kumbung->save();
        
        \Session::flash('alert-type', 'success'); 
        \Session::flash('alert-message', 'Data Kumbung Berhasil Ditambahkan!'); 
        return redirect()->route('dashboard.mitra.kumbung.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kumbung = Kumbung::findOrFail($id);

        $panen_sum = \App\Panen::select(\DB::raw('panens.pemasukan_id, SUM(panens.nominal) as panen_sum, 0 as pemasukan_sum, 0 as pengeluaran_sum'))
                        ->rightJoin('pemasukans', 'pemasukans.id', '=', 'panens.pemasukan_id')
                        ->groupBy('pemasukans.keuangan_id');
        $pemasukan_sum = \App\Pemasukan::select(\DB::raw('pemasukans.keuangan_id, panen_sum, SUM(nominal) as pemasukan_sum, 0 as pengeluaran_sum'))
                            ->leftJoinSub($panen_sum, 'panen', function($join) {
                                $join->on('pemasukans.id', '=', 'panen.pemasukan_id');
                            })
                            ->groupBy('keuangan_id');
        $pengeluaran_sum = \App\Pengeluaran::select(\DB::raw('pengeluarans.keuangan_id, SUM(nominal) as pengeluaran_sum, 0 as pemasukan_sum'))
                            ->groupBy('keuangan_id'); 
        $keuangans = \App\Keuangan::select(\DB::raw('
                                keuangans.production_id,
                                SUM(pemasukans.pemasukan_sum) as pemasukan_total, 
                                SUM(pengeluarans.pengeluaran_sum) as pengeluaran_total,
                                SUM(pemasukans.panen_sum) as panen_total'))
                            ->leftJoinSub($pemasukan_sum, 'pemasukans', function($join) {
                                $join->on('keuangans.id', '=', 'pemasukans.keuangan_id');
                            })
                            ->leftJoinSub($pengeluaran_sum, 'pengeluarans', function($join) {
                                $join->on('keuangans.id', '=', 'pengeluarans.keuangan_id');
                            })
                            ->groupBy('production_id');
        $panenKumbung = \App\Production::select(\DB::raw('SUM(panen_total) as total'))
                            ->leftJoinSub($keuangans, 'keuangans', function($join) {
                                $join->on('productions.id', '=', 'keuangans.production_id');
                            })
                            ->join('kumbungs', 'kumbungs.id', '=', 'productions.kumbung_id')
                            ->join('budidayas', 'budidayas.id', '=', 'kumbungs.budidaya_id')
                            ->where('kumbungs.id', '=', $id)
                            ->groupBy('kumbungs.id')
                            ->first();
        return view('dashboard.modules.mitra.kumbungs.show')->with([
            'kumbung' => $kumbung,
            'hasilPanen' => $panenKumbung->total
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kumbung = Kumbung::findOrFail($id);
        $budidayas = \App\Budidaya::where('owned_by_uid', '=', \Auth::user()->id)->get();
        $jamurs = \App\Jamur::all();
        return view('dashboard.modules.mitra.kumbungs.edit')->with([
            'kumbung' => $kumbung,
            'budidayas' => $budidayas,
            'jamurs' => $jamurs
        ]);
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
        $validation = \Validator::make($request->all(), [
            'name'                  => 'required|min:5|max:191',
            'large'                 => 'required|numeric|min:4',
            'status'                => 'required',
            'jamur_id'              => 'required',
            'budidaya_id'           => 'required'
        ])->validate();

        $kumbung = Kumbung::find($id);
        if ($request->file('photo')) {
            if($kumbung->photo && file_exists(storage_path('app/public/' . $kumbung->photo))){
                \Storage::delete('public/'.$kumbung->photo);
            }
            $file = $request->file('photo')->store('photo/kumbung', 'public');
            $kumbung->photo = $file;
        }
        $kumbung->name = $request->name;
        $kumbung->large = $request->large;
        $kumbung->status = $request->status;
        $kumbung->jamur_id = $request->jamur_id;
        $kumbung->budidaya_id = $request->budidaya_id;
        $kumbung->save();
        
        \Session::flash('alert-type', 'success'); 
        \Session::flash('alert-message', 'Data Kumbung Berhasil Diubah!'); 
        return redirect()->route('dashboard.mitra.kumbung.edit', $id);
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
