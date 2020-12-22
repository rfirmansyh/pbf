<?php

namespace App\Http\Controllers\Dashboard\Mitra;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Keuangan;
use Carbon\Carbon;

class KeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.modules.mitra.keuangans.index');
    }

    public function analysis(Request $request)
    {   
        $pemasukan_sum = \App\Pemasukan::select(\DB::raw('pemasukans.keuangan_id, SUM(nominal) as pemasukan_sum, 0 as pengeluaran_sum'))
                            ->groupBy('keuangan_id');
        $pengeluaran_sum = \App\Pengeluaran::select(\DB::raw('pengeluarans.keuangan_id, SUM(nominal) as pengeluaran_sum, 0 as pemasukan_sum'))
                            ->groupBy('keuangan_id'); 
        $keuangans = \App\Keuangan::select(\DB::raw('
                                keuangans.*, 
                                CONCAT(MONTHNAME(keuangans.created_at), " ", YEAR(keuangans.created_at)) as month_year, 
                                SUM(pemasukans.pemasukan_sum) as pemasukan_total, 
                                SUM(pengeluarans.pengeluaran_sum) as pengeluaran_total')
                            )
                            ->leftJoinSub($pemasukan_sum, 'pemasukans', function($join) {
                                $join->on('keuangans.id', '=', 'pemasukans.keuangan_id');
                            })
                            ->leftJoinSub($pengeluaran_sum, 'pengeluarans', function($join) {
                                $join->on('keuangans.id', '=', 'pengeluarans.keuangan_id');
                            })
                            ->leftJoin('productions', 'productions.id', '=', 'keuangans.production_id')
                            ->leftJoin('kumbungs', 'kumbungs.id', '=', 'productions.kumbung_id')
                            ->leftJoin('budidayas', 'budidayas.id', '=', 'kumbungs.budidaya_id')
                            ->where('budidayas.owned_by_uid', \Auth::user()->id)
                            ->groupBy('month_year')
                            ->orderBy('created_at')
                            ->get();
        $pemasukan_datasets = [];
        $pengeluaran_datasets = [];
        foreach ($keuangans as $i => $keuangan) {
            $pemasukan_datasets[] = [
                'created_at' => $keuangan->created_at,
                'total' => $keuangan->pemasukan_total
            ];
            $pengeluaran_datasets[] = [
                'created_at' => $keuangan->created_at,
                'total' => $keuangan->pengeluaran_total
            ];
        }
        if ( ($request->bobot !== null && $request->bobot >= 3) || ($request->next !== null) ) {
            return view('dashboard.modules.mitra.keuangans.analysis')
                ->withKeuangans($keuangans)
                ->withForecastedPemasukan(getForecasts($pemasukan_datasets, $request->bobot, $request->next))
                ->withForecastedPengeluaran(getForecasts($pengeluaran_datasets, $request->bobot, $request->next))
                ->withMessage("Analisa Data Keuangan dengan bobot $request->bobot Bulan Terakhir, dan Perkiraan $request->next Bulan Kedepan")
                ->withBobot($request->bobot)
                ->withNext($request->next);
        }
        // getForecasts($keuangan);
        return view('dashboard.modules.mitra.keuangans.analysis')
                ->withKeuangans($keuangans)
                ->withForecastedPemasukan(getForecasts($pemasukan_datasets))
                ->withForecastedPengeluaran(getForecasts($pengeluaran_datasets));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
