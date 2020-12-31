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

    public function getUsers(Request $request)
    {
        $users = \App\User::all();
        return DataTables::of($users)
            ->addColumn('id', function($user) {
                return $user->id;
            })
            ->addColumn('photo', function($user) {
                if ($user->photo) {
                    return '<div class="img-table">
                                <img src="'.asset("storage/$user->photo").'" alt="">
                            </div>';
                } else {
                    return '<div class="img-table">
                                <img src="'.asset("img/users/default.png").'" alt="">
                            </div>';
                }
            })
            ->addColumn('name', function($user) {
                return $user->name;
            })
            ->addColumn('email', function($user) {
                return $user->email;
            })
            ->addColumn('phone', function($user) {
                return $user->phone;
            })
            ->addColumn('role', function($user) {
                return $user->role->name;
            })
            ->addColumn('status', function($user) {
                if ($user->status === '1') {
                    return '<span class="badge d-block badge-success">Aktif</span>';
                } else {
                    return '<span class="badge d-block badge-secondary">Nonaktif</span>';
                }
            })
            ->addColumn('action', function($user) {
                return '<a href="'.route('dashboard.admin.users.edit', $user).'" class="btn btn-sm btn-warning mr-1"><i class="fas fa-pen"></i></a>
                        <a href="'.route('dashboard.admin.users.show', $user).'" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>';
            })
            ->rawColumns(['photo', 'status', 'action'])->make(true);
    }
    
    public function getPeminjamans(Request $request) 
    {
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
                // $remaining = Carbon::parse($peminjaman->returned_at)->diffInDays(Carbon::now()).' Hari ';
                // if ( Carbon::now()->diffInDays() < Carbon::parse($peminjaman->returned_at)->diffInDays() ) {
                //     return '<span class="badge badge-primary">'.$remaining.'</span>';
                // } elseif ( Carbon::now()->diffInDays() == Carbon::parse($peminjaman->returned_at)->diffInDays() ) {
                //     return '<span class="badge badge-warning">Hari Ini</span>';    
                // }
                // return '<span class="badge badge-secondary">Habis</span>';
                $remaining = Carbon::parse($peminjaman->returned_at)->diffInDays(Carbon::now()).' Hari ';
                if ( Carbon::now()->greaterThan(Carbon::parse($peminjaman->returned_at)) ) {
                    return '<span class="badge badge-secondary">Habis</span>';
                } elseif ( Carbon::now()->equalTo(Carbon::parse($peminjaman->returned_at)) ) {
                    return '<span class="badge badge-warning">Hari Ini</span>';    
                } else {
                    return '<span class="badge badge-primary">'.$remaining.'</span>';
                }
                
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

    public function getPengembalians(Request $request)
    {
        $pengembalians = \App\Pengembalian::get();
        return DataTables::of($pengembalians)
                ->addColumn('title', function($pengembalian) {
                    return [
                        'id' => $pengembalian->book->id,
                        'title' => substr($pengembalian->book->title, 0, 12).( (strlen($pengembalian->book->title) > 12) ? '...' : ''  ),
                        'title_full' => $pengembalian->book->title
                    ];
                })
                ->addColumn('member', function($pengembalian) {
                    return [
                        'id' => $pengembalian->member->id,
                        'name' => $pengembalian->member->name
                    ];
                })
                ->addColumn('admin', function($pengembalian) {
                    return [
                        'id' => $pengembalian->admin->id,
                        'name' => $pengembalian->admin->name
                    ];
                })
                ->addColumn('peminjaman_returned_at', function($pengembalian) {
                    return Carbon::parse($pengembalian->peminjaman_returned_at)->format('j M Y');
                })
                ->addColumn('returned_at', function($pengembalian) {
                    return Carbon::parse($pengembalian->returned_at)->format('j M Y');
                })
                ->addColumn('status', function($pengembalian) {
                    return [
                        'pengembalian_peminjaman_returned_at' => $pengembalian->peminjaman_returned_at,
                        'pengembalian_returned_at' => $pengembalian->returned_at,
                    ];
                })
                ->addColumn('denda', function($pengembalian) {
                    if ( $pengembalian->compensation > 0 ) {
                        return '<span class="text-danger font-weight-bold"> Rp. '.$pengembalian->compensation.'</span>';
                    }  else {
                        return '<span class="text-secondary font-weight-bold">-</span>';
                    }
                })
                ->addColumn('peminjaman_id', function($pengembalian) {
                    if ( $pengembalian->peminjaman ) {
                        return $pengembalian->peminjaman->id;
                    }
                    return null;
                })
                ->rawColumns(['denda'])->make(true);
    }


}
