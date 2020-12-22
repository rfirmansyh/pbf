<?php

namespace App\Http\Controllers\Dashboard\Mitra\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class MitraController extends Controller
{
    public function getUserById(Request $request, $id) {
        $user = \App\User::findOrFail($id);
        return api_response(1, 'User By Id Success', $user);
    }

    public function getKebutuhanTypeById($id) {
        $kebutuhanType = \App\KebutuhanType::find($id);
        return api_response(1, 'KebutuhanType By Id Success', $kebutuhanType);
    }

    public function getProductions(Request $request) {
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
        $productions = \App\Production::select(\DB::raw('budidayas.name as budidaya_name, kumbungs.id as kumbung_id, productions.*, pemasukan_total, pengeluaran_total, panen_total'))
                            ->leftJoinSub($keuangans, 'keuangans', function($join) {
                                $join->on('productions.id', '=', 'keuangans.production_id');
                            })
                            ->join('kumbungs', 'kumbungs.id', '=', 'productions.kumbung_id')
                            ->join('budidayas', 'budidayas.id', '=', 'kumbungs.budidaya_id')
                            ->where('budidayas.owned_by_uid', '=', \Auth::user()->id)
                            ->groupBy('productions.id')
                            ->get();
        return DataTables::of($productions)
            ->addColumn('id', function($production) {
                return $production->id;
            })
            ->addColumn('budidaya', function($production) {
                return $production->budidaya_name;
            })
            ->addColumn('kumbung', function($production) {
                return "ID : $production->kumbung_id";
            })
            ->addColumn('panen', function($production) {
                return $production->panen_total ? "$production->panen_total gram" : "0 gram";
            })
            ->addColumn('pemasukan', function($production) {
                return $production->pemasukan_total ? "Rp. $production->pemasukan_total" : "Rp. 0";
            })
            ->addColumn('pengeluaran', function($production) {
                return $production->pengeluaran_total ? "Rp. $production->pengeluaran_total" : "Rp. 0";
            })
            ->addColumn('status', function($production) {
                if ($production->status === '0') {
                    return '<span class="badge badge-secondary">Belum Mulai</span>';
                } else {
                    return '<span class="badge badge-success">In Progress</span>';
                }
            })
            ->addColumn('action', function($user) {
                return '<a href="" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>';
            })
            ->rawColumns(['status', 'action'])->make(true);
    }

    public function getKeuanganBulanans(Request $request) {
        $pemasukan_sum = \App\Pemasukan::select(\DB::raw('pemasukans.keuangan_id, SUM(nominal) as pemasukan_sum, 0 as pengeluaran_sum'))
                            ->groupBy('keuangan_id');
        $pengeluaran_sum = \App\Pengeluaran::select(\DB::raw('pengeluarans.keuangan_id, SUM(nominal) as pengeluaran_sum, 0 as pemasukan_sum'))
                            ->groupBy('keuangan_id'); 
        $keuangans = \App\Keuangan::select(\DB::raw('keuangans.*, MONTH(keuangans.created_at) as month, SUM(pemasukans.pemasukan_sum) as pemasukan_total, SUM(pengeluarans.pengeluaran_sum) as pengeluaran_total'))
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
                            ->groupBy('month')
                            ->orderBy('created_at')
                            ->get();
        return DataTables::of($keuangans)
            ->addColumn('month', function($keuangan) {
                return Carbon::parse($keuangan->created_at)->format('F Y');
            })
            ->addColumn('pemasukan', function($keuangan) {
                if ($keuangan->pemasukan_total) {
                    return "<span class='text-success font-weight-bold'> Rp. $keuangan->pemasukan_total </span>";
                } else {
                    return "<span class='text-gray font-weight-bold'> Rp. 0</span>";
                }
            })
            ->addColumn('pengeluaran', function($keuangan) {
                if ($keuangan->pengeluaran_total) {
                    return "<span class='text-warning font-weight-bold'> Rp. $keuangan->pengeluaran_total </span>";
                } else {
                    return "<span class='text-gray font-weight-bold'> Rp. 0</span>";
                }
            })
            ->rawColumns(['pemasukan', 'pengeluaran'])->make(true);
    }

    public function getPanenBulanans(Request $request) {
        $panen_sum = \App\Panen::select(\DB::raw('panens.pemasukan_id, SUM(panens.nominal) as panen_sum, 0 as pemasukan_sum, 0 as pengeluaran_sum'))
                        ->rightJoin('pemasukans', 'pemasukans.id', '=', 'panens.pemasukan_id')
                        ->groupBy('pemasukans.keuangan_id');
        $pemasukan_sum = \App\Pemasukan::select(\DB::raw('pemasukans.keuangan_id, panen_sum, SUM(nominal) as pemasukan_sum, 0 as pengeluaran_sum'))
                            ->leftJoinSub($panen_sum, 'panen', function($join) {
                                $join->on('pemasukans.id', '=', 'panen.pemasukan_id');
                            })
                            ->groupBy('keuangan_id');
        $keuangans = \App\Keuangan::select(\DB::raw('keuangans.*, MONTH(keuangans.created_at) as month, SUM(pemasukans.pemasukan_sum) as pemasukan_total, SUM(panen_sum) as panen_total'))
                            ->leftJoinSub($pemasukan_sum, 'pemasukans', function($join) {
                                $join->on('keuangans.id', '=', 'pemasukans.keuangan_id');
                            })
                            ->leftJoin('productions', 'productions.id', '=', 'keuangans.production_id')
                            ->leftJoin('kumbungs', 'kumbungs.id', '=', 'productions.kumbung_id')
                            ->leftJoin('budidayas', 'budidayas.id', '=', 'kumbungs.budidaya_id')
                            ->where('budidayas.owned_by_uid', \Auth::user()->id)
                            ->groupBy('month')
                            ->orderBy('created_at')
                            ->get();
        return DataTables::of($keuangans)
            ->addColumn('month', function($keuangan) {
                return Carbon::parse($keuangan->created_at)->format('F Y');
            })
            ->addColumn('totalPanen', function($keuangan) {
                if ($keuangan->panen_total) {
                    return "<span class='text-success font-weight-bold'> $keuangan->panen_total gram </span>";
                } else {
                    return "<span class='text-gray font-weight-bold'> - </span>";
                }
            })
            ->rawColumns(['totalPanen', 'pengeluaran'])->make(true);
    }

    public function getPekerjas(Request $request) {
        $pekerjas = \App\User::where('manager_id', \Auth::user()->id)->get();
        return DataTables::of($pekerjas)
            ->addColumn('id', function($pekerja) {
                return $pekerja->id;
            })
            ->addColumn('photo', function($pekerja) {
                return '<div class="table-img"><img src='. asset('storage/'.$pekerja->photo) .' alt=""></div>';
            })
            ->addColumn('email', function($pekerja) {
                return $pekerja->email;
            })
            ->addColumn('budidaya', function($pekerja) {
                return $pekerja->maintance_on ? $pekerja->maintance_on->name : '-';
            })
            ->addColumn('joined_at', function($pekerja) {
                return Carbon::parse($pekerja->created_at)->format('j M Y');
            })
            ->addColumn('status', function($pekerja) {
                if ($pekerja->status === '0') {
                    return '<span class="badge badge-secondary">Nonaktif</span>';
                } else {
                    return '<span class="badge badge-success">Aktif</span>';
                }
            })
            ->addColumn('action', function($pekerja) {
                return '<a href="'.route('dashboard.mitra.pekerjas.show', $pekerja->id).'" class="btn btn-sm btn-primary mr-1"><i class="fas fa-eye"></i></a>
                        <a href="'.route('dashboard.mitra.pekerjas.edit', $pekerja->id).'" class="btn btn-sm btn-warning"><i class="fas fa-pen"></i></a>';
            })
            ->rawColumns(['photo', 'status', 'action'])->make(true);
    }
}
