<?php

namespace App\Http\Controllers\Dashboard\Mitra;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Budidaya;
use Auth;

class BudidayaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $locations = Budidaya::select('kabupaten')->where('owned_by_uid', '=', \Auth::user()->id)->groupBy('kabupaten')->get();
        $status = Budidaya::select('status')->where('owned_by_uid', '=', \Auth::user()->id)->groupBy('status')->get();
        $filtered = null;

        if ($request->filter){
            $status = $request->status === '*' ? null : ($request->status === '1' ? '1' : '0');
            $kabupaten = $request->kabupaten;
            $large = intval($request->large);
            $year = $request->year ? \Carbon\Carbon::now()->subYears($request->year)->year : null;
            $keyword = $request->keyword ?  $request->keyword : '';

            
            $budidayas = Budidaya::where('owned_by_uid', '=', \Auth::user()->id)->where('name', 'LIKE', "%$keyword%");
            if ($status) $budidayas = $budidayas->where('status', $status);
            if ($kabupaten)  $budidayas = $budidayas->where('kabupaten', $kabupaten);
            if ($large) $budidayas = $budidayas->where('large', '>', $large);
            if ($year) $budidayas = $budidayas->where(\DB::raw('YEAR(created_at)'), '=', $year);
            $budidayas = $budidayas->paginate(4);

            $filtered = [
                'status' => $status,
                'location' => $request->kabupaten,
                'large' => $request->large,
                'year' => $request->year,
                'keyword' => $request->keyword
            ];
        } else {
            $budidayas = Budidaya::where('owned_by_uid', '=', \Auth::user()->id)->paginate(4);
        }   
        return view('dashboard.modules.mitra.budidaya.index')
            ->withBudidayas($budidayas)
            ->withLocations($locations)
            ->withStatus($status)
            ->withFiltered($filtered);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mainteners = \App\User::where('role_id', 3)->where('manager_id', \Auth::user()->id)->get();
        return view('dashboard.modules.mitra.budidaya.create')->with(['mainteners' => $mainteners]);
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
        ])->validate();

        $budidaya = new Budidaya;
        if ($request->file('photo')) {
            $file = $request->file('photo')->store('photo/budidaya', 'public');
            $budidaya->photo = $file;
        }
        $budidaya->name = $request->name;
        $budidaya->large = $request->large;
        $budidaya->status = $request->status;
        $budidaya->provinsi = $request->provinsi;
        $budidaya->kabupaten = $request->kabupaten;
        $budidaya->kecamatan = $request->kecamatan;
        $budidaya->kelurahan = $request->kelurahan;
        $budidaya->detail_address = $request->detail_address;
        $budidaya->owned_by_uid = Auth::user()->id;
        $budidaya->maintenance_by_uid = $request->maintenance_by_uid;
        $budidaya->save();
        
        \Session::flash('alert-type', 'success'); 
        \Session::flash('alert-message', 'Data Budidaya Berhasil Ditambahkan!'); 
        return redirect()->route('dashboard.mitra.budidaya.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $budidaya = Budidaya::findOrFail($id);
        $kumbungTotal = Budidaya::find($id)->kumbungs()->count();
        
        $pemasukan_sum = \App\Pemasukan::select(\DB::raw('pemasukans.keuangan_id, SUM(nominal) as pemasukan_sum, 0 as pengeluaran_sum'))
                            ->groupBy('keuangan_id');
        $pengeluaran_sum = \App\Pengeluaran::select(\DB::raw('pengeluarans.keuangan_id, SUM(nominal) as pengeluaran_sum, 0 as pemasukan_sum'))
                            ->groupBy('keuangan_id'); 
        $hasilBersih = Budidaya::select(\DB::raw('( COALESCE(SUM(pemasukans.pemasukan_sum), 0) - COALESCE(SUM(pengeluarans.pengeluaran_sum), 0) ) as hasilBersih '))
                            ->leftJoin('kumbungs', 'budidayas.id', '=', 'kumbungs.budidaya_id')
                            ->leftJoin('productions', 'kumbungs.id', '=', 'productions.kumbung_id')
                            ->leftJoin('keuangans', 'productions.id', '=', 'keuangans.production_id')
                            ->leftJoinSub($pemasukan_sum, 'pemasukans', function($join) {
                                $join->on('keuangans.id', '=', 'pemasukans.keuangan_id');
                            })
                            ->leftJoinSub($pengeluaran_sum, 'pengeluarans', function($join) {
                                $join->on('keuangans.id', '=', 'pengeluarans.keuangan_id');
                            })
                            ->where('budidayas.id', $id)
                            ->groupBy('budidayas.id')
                            ->first();

        return view('dashboard.modules.mitra.budidaya.show')->with([
            'budidaya' => $budidaya,
            'kumbungTotal' => $kumbungTotal,
            'hasilBersih' => $hasilBersih->hasilBersih
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
        $budidaya = Budidaya::findOrFail($id);
        $mainteners = \App\User::where('role_id', 3)->where('manager_id', \Auth::user()->id)->get();
        return view('dashboard.modules.mitra.budidaya.edit')->with(['budidaya' => $budidaya, 'mainteners' => $mainteners]);
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
        ])->validate();
        $budidaya = Budidaya::findOrFail($id);
        if ($request->file('photo')) {
            if($budidaya->photo && file_exists(storage_path('app/public/' . $budidaya->photo))){
                \Storage::delete('public/'.$budidaya->photo);
            }
            $file = $request->file('photo')->store('photo/budidaya', 'public');
            $budidaya->photo = $file;
        }
        $budidaya->name = $request->name;
        $budidaya->large = $request->large;
        $budidaya->status = $request->status;
        if ($request->provinsi && $request->kabupaten && $request->kecamatan && $request->kelurahan) {
            $user->provinsi = $request->provinsi;
            $user->kabupaten = $request->kabupaten;
            $user->kecamatan = $request->kecamatan;
            $user->kelurahan = $request->kelurahan;
        }
        if ($request->detail_address){
            $user->detail_address = $request->detail_address;
        }
        if ($request->maintenance_by_uid) {
            $budidaya->maintenance_by_uid = $request->maintenance_by_uid;
        }

        $budidaya->save();
        \Session::flash('alert-type', 'success'); 
        \Session::flash('alert-message', 'Data Budidaya Berhasil Diubah!'); 
        return redirect()->route('dashboard.mitra.budidaya.edit', $id);
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

    public function destroyBudidaya($id) {
        $budidaya = Budidaya::findOrFail($id);
        $budidaya->maintenance_by_uid = null;
        $budidaya->save();

        return redirect()->route('dashboard.mitra.budidaya.edit', $id);
    }
}
