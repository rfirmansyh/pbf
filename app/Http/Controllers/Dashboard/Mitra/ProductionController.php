<?php

namespace App\Http\Controllers\Dashboard\Mitra;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Production;

class ProductionController extends Controller
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
        $productionTypes = \App\ProductionType::all();
        $kebutuhanTypes = \App\KebutuhanType::all();
        return view('dashboard.modules.mitra.productions.index')
            ->withBudidayas($budidayas)
            ->withBudidayaSelected($budidayaSelected)
            ->withKumbungs($kumbungs)
            ->withProductionTypes($productionTypes)
            ->withKebutuhanTypes($kebutuhanTypes);
    }


    public function indextable()
    {
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
        $productions = \App\Production::select(\DB::raw('productions.*, pemasukan_total, pengeluaran_total, panen_total'))
                            ->leftJoinSub($keuangans, 'keuangans', function($join) {
                                $join->on('productions.id', '=', 'keuangans.production_id');
                            })
                            ->join('kumbungs', 'kumbungs.id', '=', 'productions.kumbung_id')
                            ->join('budidayas', 'budidayas.id', '=', 'kumbungs.budidaya_id')
                            ->where('budidayas.owned_by_uid', '=', \Auth::user()->id)
                            ->groupBy('productions.id')
                            ->get();
        return view('dashboard.modules.mitra.productions.index-table');
    }

    public function indexpanen()
    {
        return view('dashboard.modules.mitra.productions.panen');
    }

    public function panenAnalysis(Request $request) 
    {
        $panen_sum = \App\Panen::select(\DB::raw('panens.pemasukan_id, SUM(panens.nominal) as panen_sum, 0 as pemasukan_sum, 0 as pengeluaran_sum'))
                        ->rightJoin('pemasukans', 'pemasukans.id', '=', 'panens.pemasukan_id')
                        ->groupBy('pemasukans.keuangan_id');
        $pemasukan_sum = \App\Pemasukan::select(\DB::raw('pemasukans.keuangan_id, panen_sum, SUM(nominal) as pemasukan_sum, 0 as pengeluaran_sum'))
                        ->leftJoinSub($panen_sum, 'panen', function($join) {
                            $join->on('pemasukans.id', '=', 'panen.pemasukan_id');
                        })
                        ->groupBy('keuangan_id');
        // dd($pemasukan_sum->get());
        $keuangans = \App\Keuangan::select(\DB::raw('
                                keuangans.*, 
                                CONCAT(MONTHNAME(keuangans.created_at), " ", YEAR(keuangans.created_at)) as month_year, 
                                COALESCE(SUM(pemasukans.panen_sum), 0) as panen_total')
                            )
                            ->leftJoinSub($pemasukan_sum, 'pemasukans', function($join) {
                                $join->on('keuangans.id', '=', 'pemasukans.keuangan_id');
                            })
                            ->leftJoin('productions', 'productions.id', '=', 'keuangans.production_id')
                            ->leftJoin('kumbungs', 'kumbungs.id', '=', 'productions.kumbung_id')
                            ->leftJoin('budidayas', 'budidayas.id', '=', 'kumbungs.budidaya_id')
                            ->where('budidayas.owned_by_uid', \Auth::user()->id)
                            ->groupBy('month_year')
                            ->orderBy('keuangans.created_at')
                            ->get();
        $panen_datasets = [];
        foreach ($keuangans as $i => $keuangan) {
            $panen_datasets[] = [
                'created_at' => $keuangan->created_at,
                'total' => $keuangan->panen_total
            ];
        }     
        if ( ($request->bobot !== null && $request->bobot >= 3) || ($request->next !== null) ) {
            return view('dashboard.modules.mitra.productions.panen-analysis')
                ->withKeuangans($keuangans)
                ->withForecastedPanen(getForecasts($panen_datasets, $request->bobot, $request->next))
                ->withMessage("Analisa Data Keuangan dengan bobot $request->bobot Bulan Terakhir, dan Perkiraan $request->next Bulan Kedepan")
                ->withBobot($request->bobot)
                ->withNext($request->next);
        }
        // getForecasts($keuangan);
        return view('dashboard.modules.mitra.productions.panen-analysis')
                ->withKeuangans($keuangans)
                ->withForecastedPanen(getForecasts($panen_datasets));   
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $production = new Production;
        $production->name = $request->name;
        $production->description = $request->description;
        $production->created_at = Carbon::parse($request->created_at);
        $production->done_at = Carbon::parse($request->done_at);
        $production->status = '1';
        $production->production_type_id = $request->production_type_id;
        $production->maked_by_uid = $request->maked_by_uid;
        $production->updated_by_uid = $request->updated_by_uid;
        $production->kumbung_id = $request->kumbung_id;
        $production->save();

        $keuangan = new \App\Keuangan;
        $keuangan->name = "Data Keuangan Produksi $production->id";
        $keuangan->description = "Deskripsi Keuangan Produksi $production->id";
        $keuangan->created_at = now();
        $keuangan->production_id = $production->id;
        $keuangan->save();

        $pengeluarans = [];
        $kebutuhans = [];
        foreach ($request->pengeluaran_nominal as $i => $value) {
            $pengeluarans[] = [
                'nominal' => $request->pengeluaran_nominal[$i] ? $request->pengeluaran_nominal[$i] : 0,
                'description' => $request->pengeluaran_description[$i],
                'keuangan_id' => $keuangan->id
            ];
            DB::table('pengeluarans')->insert($pengeluarans[$i]);
            $kebutuhans[] = [
                'nominal' => $request->kebutuhan_nominal[$i] ? $request->kebutuhan_nominal[$i] : 0,
                'kebutuhan_type_id' => $request->kebutuhan_type_id[$i],
                'pengeluaran_id' => \App\Pengeluaran::orderBy('id', 'desc')->first()->id
            ]; 
        }
        DB::table('kebutuhans')->insert($kebutuhans);
        
        // $this->command->info("Data Dummy Pengeluaran berhasil diinsert");
        \Session::flash('alert-type', 'success'); 
        \Session::flash('alert-message', 'Data Produksi Berhasil Ditambahkan!'); 
        return redirect()->route('dashboard.mitra.productions.index');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function inputdata(Request $request, $id)
    {   
        // check all
        if(
            in_array(!null, $request->panen_nominal) ||
            in_array(!null, $request->kebutuhan_nominal) ||
            in_array(!null, $request->pemasukan_other_nominal) ||
            in_array(!null, $request->pengeluaran_other_nominal)
        ) {

            $production = Production::findOrFail($id);
            $production->updated_by_uid = $request->updated_by_uid;
            $production->save();

            $keuangan_num_next = \App\Keuangan::where('production_id', '=', $id)->count() + 1;
            $keuangan = new \App\Keuangan;
            $keuangan->name = "Data Keuangan Produksi ID: $production->id ke $keuangan_num_next";
            $keuangan->description = "Deskripsi Keuangan Produksi ID: $production->id ke $keuangan_num_next";
            $keuangan->created_at = now();
            $keuangan->production_id = $production->id;
            $keuangan->save();

            $panens = [];
            // if panen nominal not contain null
            if (in_array(!null, $request->panen_nominal)) {
                $pemasukans = [];
                foreach ($request->panen_nominal as $i => $value) {
                    $pemasukans[] = [
                        'nominal' => $request->pemasukan_nominal[$i] ? $request->pemasukan_nominal[$i] : 0,
                        'description' => $request->pemasukan_description[$i],
                        'keuangan_id' => $keuangan->id
                    ];
                    if ($value !== null) {
                        DB::table('pemasukans')->insert($pemasukans[$i]);
                        $panens[] = [
                            'nominal' => $request->panen_nominal[$i] ? $request->panen_nominal[$i] : 0,
                            'description' => $request->panen_description[$i],
                            'panen_at' => $request->panen_at[$i] !== null ? Carbon::parse($request->panen_at[$i]) : Carbon::now(),
                            'pemasukan_id' => \App\Pemasukan::orderBy('id', 'desc')->first()->id
                        ]; 
                    }
                }
                DB::table('panens')->insert($panens);
                
            }

            $kebutuhans = [];
            // if kebutuhan nominal not contain null
            if (in_array(!null, $request->kebutuhan_nominal)) {
                $pengeluarans = [];
                foreach ($request->kebutuhan_nominal as $i => $value) {
                    $pengeluarans[] = [
                        'nominal' => $request->pengeluaran_nominal[$i] ? $request->pengeluaran_nominal[$i] : 0,
                        'description' => $request->pengeluaran_description[$i],
                        'keuangan_id' => $keuangan->id
                    ];
                    if ($value !== null) {
                        DB::table('pengeluarans')->insert($pengeluarans[$i]);
                        $kebutuhans[] = [
                            'nominal' => $request->kebutuhan_nominal[$i] ? $request->kebutuhan_nominal[$i] : 0,
                            'kebutuhan_type_id' => $request->kebutuhan_type_id[$i],
                            'pengeluaran_id' => \App\Pengeluaran::orderBy('id', 'desc')->first()->id
                        ]; 
                    }
                }
                DB::table('kebutuhans')->insert($kebutuhans);
            }

            $pemasukan_others = [];
            // if pemasukan other nominal not contain null
            if (in_array(!null, $request->pemasukan_other_nominal)) {
                foreach ($request->pemasukan_other_nominal as $i => $value) {
                    if($value !== null) {
                        $pemasukan_others[] = [
                            'nominal' => $request->pemasukan_other_nominal[$i] ? $request->pemasukan_other_nominal[$i] : 0,
                            'description' => $request->pemasukan_other_description[$i],
                            'keuangan_id' => $keuangan->id
                        ];
                    }
                }
                DB::table('pemasukans')->insert($pemasukan_others);
            }

            $pengeluaran_others = [];
            // if pengeluaran other nominal not contain null
            if (in_array(!null, $request->pengeluaran_other_nominal)) {
                foreach ($request->pengeluaran_other_nominal as $i => $value) {
                    if ($value !== null) {
                        $pengeluaran_others[] = [
                            'nominal' => $request->pengeluaran_other_nominal[$i] ? $request->pengeluaran_other_nominal[$i] : 0,
                            'description' => $request->pengeluaran_other_description[$i],
                            'keuangan_id' => $keuangan->id
                        ];
                    }
                }
                DB::table('pengeluarans')->insert($pengeluaran_others);
            }

            $feedback = "Input Data Produksi : ";
            $result_panen = count($panens);
            $result_kebutuhan = count($kebutuhans);
            $result_pemasukan_other = count($pemasukan_others);
            $result_pengeluaran_other = count($pengeluaran_others);
            if ($result_panen != 0) { $feedback .= "$result_panen Data Panen, "; }
            if ($result_kebutuhan != 0) { $feedback .= "$result_kebutuhan Data Kebutuhan, "; }
            if ($result_pemasukan_other != 0) { $feedback .= "$result_pemasukan_other Data Pemasukan, "; }
            if ($result_pengeluaran_other != 0) { $feedback .= "$result_pengeluaran_other Data Pengeluaran, "; }
            $feedback .= "Berhasil !";

            \Session::flash('alert-type', 'success'); 
            \Session::flash('alert-message', $feedback); 
            return redirect()->route('dashboard.mitra.productions.index');
        } else {
            \Session::flash('alert-type', 'warning'); 
            \Session::flash('alert-message', 'Gagal Input Data, semua data kosong !'); 
            return redirect()->back()->withErrors('Input Nominal ini tidak boleh kosong semua', 'nominal');
        }
        
        
    }

    public function updatestatus(Request $request, $id)
    {
        $production = Production::findOrFail($id);
        $production->status = $request->status;
        $production->save();
        \Session::flash('alert-type', 'success'); 
        \Session::flash('alert-message', "Produksi Kumbung ID : $production->kumbung_id : ". $production->kumbung->name ." Berhasil Diselesaikan"); 
        return redirect()->route('dashboard.mitra.productions.index');
    }

}
