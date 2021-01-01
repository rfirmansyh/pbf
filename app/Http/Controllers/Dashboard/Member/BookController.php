<?php

namespace App\Http\Controllers\Dashboard\Member;

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
        return view('dashboard.modules.member.books.index')->with([
            'books' => $books
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('dashboard.modules.member.books.show')->with([
            'book' => $book
        ]);
    }

}
