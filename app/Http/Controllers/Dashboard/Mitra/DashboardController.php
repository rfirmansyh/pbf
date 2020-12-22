<?php

namespace App\Http\Controllers\Dashboard\Mitra;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPekerja = \App\User::where('id',\Auth::user()->id)->first()->workers()->count();
        $totalBudidaya = \App\User::where('id',\Auth::user()->id)->first()->budidayas()->count();
        $totalKumbung = \App\User::select(\DB::raw('COUNT(kumbungs.id) as totalKumbung'))
                                    ->leftJoin('budidayas', 'users.id', '=', 'budidayas.owned_by_uid')
                                    ->leftJoin('kumbungs', 'budidayas.id', '=', 'kumbungs.budidaya_id')
                                    ->where('users.id', \Auth::user()->id)
                                    ->groupBy('users.id')
                                    ->first()->totalKumbung;
        $totalProduksi = \App\User::select(\DB::raw('COUNT(productions.id) as totalProduksi'))
                                    ->leftJoin('budidayas', 'users.id', '=', 'budidayas.owned_by_uid')
                                    ->leftJoin('kumbungs', 'budidayas.id', '=', 'kumbungs.budidaya_id')
                                    ->leftJoin('productions', 'kumbungs.id', '=', 'productions.kumbung_id')
                                    ->where('users.id', \Auth::user()->id)
                                    ->groupBy('users.id')
                                    ->first()->totalProduksi;
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
                                keuangans.*, 
                                CONCAT(MONTHNAME(keuangans.created_at), " ", YEAR(keuangans.created_at)) as month_year, 
                                SUM(pemasukans.pemasukan_sum) as pemasukan_total,
                                SUM(pengeluarans.pengeluaran_sum) as pengeluaran_total,
                                SUM(pemasukans.panen_sum) as panen_total,
                                (SUM(pemasukans.pemasukan_sum) - SUM(pengeluarans.pengeluaran_sum)) as hasil_bersih')
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
        return view('dashboard.modules.mitra.index')->with([
            'totalPekerja' => $totalPekerja,
            'totalBudidaya' => $totalBudidaya,
            'totalKumbung' => $totalKumbung,
            'totalProduksi' => $totalProduksi,
            'keuangans' => $keuangans
        ]);
    }

    public function profile()
    {
        $user = \Auth::user();
        return view('dashboard.modules.mitra.profile')->with([
            'mitra' => $user
        ]);
    }
}
