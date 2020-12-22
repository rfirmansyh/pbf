<?php

namespace App\Http\Controllers\Dashboard\Pekerja;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProductions = \App\Production::where('maked_by_uid', \Auth::user()->id)
                            ->orWhere('maked_by_uid', \Auth::user()->work_on->id)
                            ->count();
        $totalProductionsActive = \App\Production::where('maked_by_uid', \Auth::user()->id)
                            ->orWhere('maked_by_uid', \Auth::user()->work_on->id)
                            ->where('status', '1')
                            ->count();
        $totalProductionsNonActive = \App\Production::where('maked_by_uid', \Auth::user()->id)
                            ->orWhere('maked_by_uid', \Auth::user()->work_on->id)
                            ->where('status', '2')
                            ->count();
        
        $budidaya = \App\Budidaya::where('maintenance_by_uid', '=', \Auth::user()->id)->first();

        return view('dashboard.modules.pekerja.index')->with([
            'budidaya'  => $budidaya,
            'totalProductions' => $totalProductions,
            'totalProductionsActive' => $totalProductionsActive,
            'totalProductionsNonActive' => $totalProductionsNonActive,
        ]);
    }

    public function profile()
    {
        $user = \Auth::user();
        return view('dashboard.modules.pekerja.profile')->with([
            'pekerja' => $user
        ]);
    }
}
