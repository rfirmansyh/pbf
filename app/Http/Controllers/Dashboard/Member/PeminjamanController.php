<?php

namespace App\Http\Controllers\Dashboard\Member;

use App\Http\Controllers\Controller;
use App\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.modules.member.peminjamans.index');
    }

}
