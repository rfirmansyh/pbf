<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $articles = file_get_contents(base_path('resources/data/articles.json'));
        $articles = json_decode($articles);
        // dd($articles);
        return view('index')->with(['articles' => $articles]);
    }

    public function show($id)
    {
        $articles = file_get_contents(base_path('resources/data/articles.json'));
        $articles = json_decode($articles);
        $get_article;
        foreach ($articles as $i => $article) {
            if ($article->id == $id) {
                $get_article = $article;
            }
        }
        return view('show')->with(['article' => $get_article]);
    }

    public function create(Request $request) 
    {

        return view('create');
    }

    public function store(Request $request)
    {
        $articles = file_get_contents(base_path('resources/data/articles.json'));
        $articles = json_decode($articles);

        $validation = \Validator::make($request->all(), [
            'title'                 => 'required',
            'content'               => 'required',
            'author'                => 'required',
        ])->validate();

        $file = '';
        if ($request->file('img')) {
            $file = $request->file('img')->store('articles', 'public');
        }

        $article = new class{};
        $article->id = $articles[count($articles)-1]->id + 1;
        $article->img = $file;
        $article->title = $request->title;
        $article->content = $request->content;
        $article->author = $request->author;

        
        $articles[] = $article;
        $articles = json_encode($articles, JSON_PRETTY_PRINT);
        file_put_contents(base_path('resources/data/articles.json'), $articles);

        \Session::flash('type', 'success'); 
        \Session::flash('message', 'Data Artike Berhasil Ditamba !'); 
        return redirect()->route('articles.create');
    }

    public function edit($id)
    {
        $articles = file_get_contents(base_path('resources/data/articles.json'));
        $articles = json_decode($articles);
        
        $get_article;
        foreach ($articles as $i => $article) {
            if ($article->id == $id) {
                $get_article = $article;
            }
        }
        
        return view('edit')->with(['article' => $get_article]);
    }

    public function update(Request $request, $id)
    {
        $articles = file_get_contents(base_path('resources/data/articles.json'));
        $articles = json_decode($articles);

        $validation = \Validator::make($request->all(), [
            'title'                 => 'required',
            'content'               => 'required',
            'author'                => 'required',
        ])->validate();

        $get_article;
        $get_article_index;
        foreach ($articles as $i => $article) {
            if ($article->id == $id) {
                $get_article = $article;
                $get_article_index = $i;
            }
        }

        $file = '';
        if ($request->file('img')) {
            $file = $request->file('img')->store('articles', 'public');
        } else {
            $file = $get_article->img;
        }

        $article = new class{};
        $article->id = $get_article->id;
        $article->img = $file;
        $article->title = $request->title;
        $article->content = $request->content;
        $article->author = $request->author;

        
        $articles[$get_article_index] = $article;
        $articles = json_encode($articles, JSON_PRETTY_PRINT);
        file_put_contents(base_path('resources/data/articles.json'), $articles);

        \Session::flash('type', 'success'); 
        \Session::flash('message', 'Data Artikel Berhasil Diubah !'); 
        return redirect()->route('articles.edit', $id);
    }

    public function destroy($id) 
    {
        $articles = file_get_contents(base_path('resources/data/articles.json'));
        $articles = json_decode($articles);
        
        $get_article_index;

        foreach ($articles as $i => $article) {
            if ($article->id == $id) {
                $get_article_index = $i;
            }
        }
        array_splice($articles, $get_article_index, 1);
        
        $articles = json_encode($articles, JSON_PRETTY_PRINT);
        file_put_contents(base_path('resources/data/articles.json'), $articles);
        
        \Session::flash('type', 'success'); 
        \Session::flash('message', 'Data Artikel Berhasil Dihapus!'); 
        return redirect()->route('index');
    }
}
