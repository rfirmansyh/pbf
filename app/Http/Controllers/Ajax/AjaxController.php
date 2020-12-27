<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class AjaxController extends Controller
{

    public function getUserById($id)
    {
        $user = \App\User::find($id);
        return api_response(1, 'Get User By Id success', $user);
    }

    public function getBookById($id)
    {
        $book = \App\Book::find($id);
        return api_response(1, 'Get Book By Id success', $book);
    }
    
    public function getPeminjamans(Request $request) 
    {
        // if ($request->id) {
        //     dd($request->id);
        // }
        $peminjamans = \App\Peminjaman::get();
        return DataTables::of($peminjamans)
            ->addColumn('title', function($peminjaman) {
                return [
                    'id' => $peminjaman->book->id,
                    'title' => substr($peminjaman->book->title, 0, 12).( (strlen($peminjaman->book->title) > 12) ? '...' : ''  ),
                    'title_full' => $peminjaman->book->title
                ];
            })
            ->addColumn('member', function($peminjaman) {
                return [
                    'id' => $peminjaman->member->id,
                    'name' => $peminjaman->member->name
                ];
            })
            ->addColumn('admin', function($peminjaman) {
                return [
                    'id' => $peminjaman->admin->id,
                    'name' => $peminjaman->admin->name
                ];
            })
            ->addColumn('borrowed_at', function($peminjaman) {
                return Carbon::parse($peminjaman->borrowed_at)->format('j M Y');
            })
            ->addColumn('returned_at', function($peminjaman) {
                return Carbon::parse($peminjaman->returned_at)->format('j M Y');
            })
            ->addColumn('date_remaining', function($peminjaman) {
                $remaining = Carbon::parse($peminjaman->returned_at)->diffInDays(Carbon::now()).' Hari ';
                if ( Carbon::now()->diffInDays() < Carbon::parse($peminjaman->returned_at)->diffInDays() ) {
                    return '<span class="badge badge-primary">'.$remaining.'</span>';
                } elseif ( Carbon::now()->diffInDays() == Carbon::parse($peminjaman->returned_at)->diffInDays() ) {
                    return '<span class="badge badge-warning">Hari Ini</span>';    
                }
                return '<span class="badge badge-secondary">Habis</span>';
            })
            ->addColumn('status', function($peminjaman) {
                if ( $peminjaman->pengembalian ) {
                    return [
                        'peminjaman_id' => $peminjaman->id,
                        'pengembalian_id' => $peminjaman->pengembalian->id,
                        'peminjaman_returned_at' => $peminjaman->returned_at,
                        'pengembalian_returned_at' => $peminjaman->pengembalian->returned_at,
                    ];
                    // if ( $peminjaman->pengembalian->returned_at < $peminjaman->returned_at ) {
                    //     return '<span class="badge badge-success">Dikembalikan</span>';
                    // } else {
                    //     return '<span class="badge badge-danger">terlambat</span>';
                    // }
                } 
                return 0;
                // return '<span class="badge badge-secondary">Dipinjam</span>';
            })
            ->addColumn('action', function($peminjaman) {
                return $peminjaman->id;
            })
            ->rawColumns(['photo', 'date_remaining', 'status'])->make(true);
    }

}
