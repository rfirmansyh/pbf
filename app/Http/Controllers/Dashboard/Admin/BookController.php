<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Book;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $books = Book::paginate(6);
        if ($request->search) {
            $books = Book::where('title', 'LIKE', "%$request->search%")->paginate(6);
        }
        return view('dashboard.modules.admin.books.index')->with([
            'books' => $books
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $raks = \App\Rak::all();
        return view('dashboard.modules.admin.books.create')->with([
            'raks' => $raks
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
            'title'                   => 'required',
            'code'                    => 'required',
            'writer'                  => 'required',  
            'publisher'               => 'required',    
            'year_published'          => 'required',         
            'stock'                   => 'required',
            'rak_id'                  => 'required', 
        ])->validate();

        $book = new Book;
        if ($request->file('photo')) {
            $file = $request->file('photo')->store('books', 'public');
            $book->photo = $file;
        }
        $book->title = $request->title;
        $book->code = $request->code;
        $book->writer = $request->writer;
        $book->publisher = $request->publisher;
        $book->year_published = $request->year_published;
        $book->stock = $request->stock;
        $book->rak_id = $request->rak_id;
        $book->description = $request->description;

        $book->save();
        \Session::flash('alert-type', 'success'); 
        \Session::flash('alert-message', 'Data Mitra Berhasil Ditambahkan!'); 
        
        $raks = \App\Rak::all();
        return redirect()->route('dashboard.admin.books.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $raks = \App\Rak::all();
        return view('dashboard.modules.admin.books.edit')->with([
            'book' => $book,
            'raks' => $raks
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $validation = \Validator::make($request->all(), [
            'title'                   => 'required|min:10',
            'code'                    => 'required',
            'writer'                  => 'required',  
            'publisher'               => 'required',    
            'year_published'          => 'required',         
            'stock'                   => 'required',
            'rak_id'                  => 'required', 
        ])->validate();

        if ($request->file('photo')) {
            if($book->photo && file_exists(storage_path('app/public/' . $book->photo))){
                \Storage::delete('public/'.$book->photo);
            }
            $file = $request->file('photo')->store('books', 'public');
            $book->photo = $file;
        }
        $book->title = $request->title;
        $book->code = $request->code;
        $book->writer = $request->writer;
        $book->publisher = $request->publisher;
        $book->year_published = $request->year_published;
        $book->stock = $request->stock;
        $book->rak_id = $request->rak_id;
        $book->description = $request->description;

        $book->save();
        \Session::flash('alert-type', 'success'); 
        \Session::flash('alert-message', 'Data Mitra Berhasil Ditambahkan!'); 
        
        $raks = \App\Rak::all();
        return redirect()->route('dashboard.admin.books.edit', $book);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }
}
