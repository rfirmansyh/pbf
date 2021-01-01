<?php

namespace App\Http\Controllers\Frontpage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontpageController extends Controller
{
    public function index(Request $request) 
    {
        $books = \App\Book::paginate(6);
        if ($request->search) {
            $books = \App\Book::where('title', 'LIKE', "%$request->search%")->paginate(6);
            if ( count($books) > 0) {
                \Session::flash('alert-type', 'success'); 
                \Session::flash('alert-message', 'Menampilkan buku dengan keyword "'.$request->search.'" !'); 
            } else {
                \Session::flash('alert-type', 'warning'); 
                \Session::flash('alert-message', 'Tidak ada buku dengan  keyword "'.$request->search.'" !'); 
            }
        }
        return view('frontpage.index')->with([
            'books' => $books,
            'search' => $request->search
        ]);
    }

    public function about()
    {
        return view('frontpage.about');
    }
    
    public function documentation()
    {
        return view('frontpage.documentation');
    }
    
}
