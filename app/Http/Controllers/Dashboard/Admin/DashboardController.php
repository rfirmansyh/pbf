<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{


    public function index()
    {
        $users = \App\User::where('role_id', '=', 2)->get();
        $budidayas = \App\Budidaya::all();
        $productions = \App\Production::all();
        $users_bulanan = \App\User::select(\DB::raw('COUNT(users.id) as total_user, CONCAT(MONTHNAME(users.created_at), " ", YEAR(users.created_at)) as month_year'))
                            ->where('role_id', 2)
                            ->groupBy(\DB::raw('MONTH(created_at)'))->get();
        // dd($users_bulanan);
        return view('dashboard.modules.admin.index')->with([
            'users' => $users,
            'budidayas' => $budidayas,
            'productions' => $productions,
            'users_bulanan' => $users_bulanan
        ]);
    }

    public function profile()
    {
        $user = \Auth::user();
        return view('dashboard.modules.admin.profile')->with([
            'admin' => $user
        ]);
    }

    public function test()
    {
        $user = \App\User::find('1')->role->id;
        dd($user);
        return view('dashboard.modules.admin.index')->withRoles($roles);
    }
}
