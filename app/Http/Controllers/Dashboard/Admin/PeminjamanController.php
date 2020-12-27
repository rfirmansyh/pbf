<?php

namespace App\Http\Controllers\Dashboard\Admin;

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
        return view('dashboard.modules.admin.peminjamans.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $books = \App\Book::where('stock', '>', 0)->get();
        $members = \App\User::where('role_id', 2)->get();
        return view('dashboard.modules.admin.peminjamans.create')->with([
            'books' => $books,
            'members' => $members
        ]);
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
            'book_id'           => 'required',
            'member_id'         => 'required',    
            'borrowed_at'       => 'required',    
            'returned_at'       => 'required',    
        ])->validate();

        $peminjaman = new Peminjaman;
        $peminjaman->book_id = $request->book_id;
        $peminjaman->member_id = $request->member_id;
        $peminjaman->borrowed_at = \Carbon\Carbon::parse($request->borrowed_at);
        $peminjaman->returned_at = \Carbon\Carbon::parse($request->returned_at);
        $peminjaman->admin_id = \App\User::where('role_id', 1)->first()->id;
        $peminjaman->save();

        // // update stock book
        $book = \App\Book::find($peminjaman->book_id);
        $book->stock = $book->stock - 1;
        $book->save();

        \Session::flash('alert-type', 'success'); 
        \Session::flash('alert-message', 'Data Peminjaman Berhasil Ditambahkan!'); 
        
        return redirect()->route('dashboard.admin.peminjamans.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $peminjaman = Peminjaman::find($id);
        return view('dashboard.modules.admin.peminjamans.show')->with([
            'peminjaman' => $peminjaman,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $peminjaman = Peminjaman::find($id);
        $books = \App\Book::where('stock', '>', 0)->get();
        $members = \App\User::where('role_id', 2)->get();
        return view('dashboard.modules.admin.peminjamans.edit')->with([
            'peminjaman' => $peminjaman,
            'books' => $books,
            'members' => $members
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Peminjaman $peminjaman)
    {
        $validation = \Validator::make($request->all(), [
            'book_id'           => 'required',
            'member_id'         => 'required',    
            'borrowed_at'       => 'required',    
            'returned_at'       => 'required',    
        ])->validate();

        // // update stock book
        if (intval($request->book_id) !== $peminjaman->book_id) {
            $book = \App\Book::find($peminjaman->book_id);
            $book->stock = $book->stock + 1;
            $book->save();

            $book_new = \App\Book::find(intval($request->book_id));
            $book_new->stock = $book_new->stock - 1;
            $book_new->save();
        }

        $peminjaman->book_id = $request->book_id;
        $peminjaman->member_id = $request->member_id;
        $peminjaman->borrowed_at = \Carbon\Carbon::parse($request->borrowed_at);
        $peminjaman->returned_at = \Carbon\Carbon::parse($request->returned_at);
        $peminjaman->admin_id = \App\User::where('role_id', 1)->first()->id;
        $peminjaman->save();

        
        

        \Session::flash('alert-type', 'success'); 
        \Session::flash('alert-message', 'Data Peminjaman Berhasil Diubah!'); 
        
        return redirect()->route('dashboard.admin.peminjamans.edit', $peminjaman->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function destroy(Peminjaman $peminjaman)
    {
        //
    }
}
