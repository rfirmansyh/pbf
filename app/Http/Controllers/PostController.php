<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Jsonable;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $startPage = 0;
        $perPage = 5;
        if($request->page) {
            $startPage = ($request->page - 1) * $perPage;
        }

        $posts = file_get_contents(base_path('public/json/posts.json'));
        $posts = json_decode($posts);
        $posts = \App\Post::hydrate($posts);
        $posts = new \Illuminate\Pagination\LengthAwarePaginator($posts, count($posts), 5);
        $posts->withPath('/182410102024/uts/public/posts');
        return view('posts.index')->with(['posts' => $posts, 'startPage' => $startPage, 'endPage' => ( ($startPage+5) > count($posts) ? count($posts) : $startPage+5)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
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
            'title'                 => 'required|min:5|max:35',
            'body'                  => 'required|min:10',
            'author'                => 'required|min:3',
        ])->validate();

        $posts = file_get_contents(base_path('public/json/posts.json'));
        $posts = json_decode($posts);
        $file = '';
        if ($request->file('img')) {
            $file = $request->file('img')->store('posts', 'public');
        }

        $post = (object) [
            'id' => count($posts)+1,
            'img' => $file,
            'title' => $request->title,
            'body' => $request->body,
            'author' => $request->author,
            'created' => now(),
            'updated' => null
        ];
        
        $posts[] = $post;
        $posts = json_encode($posts, JSON_PRETTY_PRINT);
        file_put_contents(base_path('public/json/posts.json'), $posts);

        \Session::flash('alert-type', 'success'); 
        \Session::flash('alert-message', 'Data Blog Berhasil Ditambahkan!'); 
        return redirect()->route('posts.create');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts = file_get_contents(base_path('public/json/posts.json'));
        $posts = json_decode($posts);
        
        $post;
        foreach ($posts as $i => $value) {
            if ($value->id == $id) {
                $post = $value;
            }
        }

        return view('posts.show')->with(['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts = file_get_contents(base_path('public/json/posts.json'));
        $posts = json_decode($posts);
        
        $post;
        foreach ($posts as $i => $value) {
            if ($value->id == $id) {
                $post = $value;
            }
        }
        // dd($post);
        
        return view('posts.edit')->with(['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = \Validator::make($request->all(), [
            'title'                 => 'required|min:5|max:35',
            'body'                  => 'required|min:10',
            'author'                => 'required|min:3',
        ])->validate();

        $posts = file_get_contents(base_path('public/json/posts.json'));
        $posts = json_decode($posts);
        
        $post;
        $post_index_updated;

        foreach ($posts as $i => $value) {
            if ($value->id == $id) {
                $post = $value;
                $post_index_updated = $i;
            }
        }
        $file = $post->img;
        if ($request->file('img')) {
            $file = $request->file('img')->store('posts', 'public');
        }
        
        $post = (object) [
            'id' => $post->id,
            'img' => $file,
            'title' => $request->title,
            'body' => $request->body,
            'author' => $request->author,
            'created' => null,
            'updated' => now()
        ];

        $posts[$post_index_updated] = $post;
        $posts = json_encode($posts, JSON_PRETTY_PRINT);
        file_put_contents(base_path('public/json/posts.json'), $posts);
        
        \Session::flash('alert-type', 'success'); 
        \Session::flash('alert-message', 'Data Blog Berhasil Diubah!'); 
        return redirect()->route('posts.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $posts = file_get_contents(base_path('public/json/posts.json'));
        $posts = json_decode($posts);
        
        $post_index_updated;

        foreach ($posts as $i => $value) {
            if ($value->id == $id) {
                $post_index_updated = $i;
            }
        }
        array_splice($posts, $post_index_updated, 1);
        
        $posts = json_encode($posts, JSON_PRETTY_PRINT);
        file_put_contents(base_path('public/json/posts.json'), $posts);
        
        \Session::flash('alert-type', 'success'); 
        \Session::flash('alert-message', 'Data Blog Berhasil Dihapus!'); 
        return redirect()->route('posts.index');
    }

    
    
}
