<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $startPage = 0;
        $perPage = 4;
        if($request->page) {
            $startPage = ($request->page - 1) * $perPage;
        }

        $posts = file_get_contents(base_path('public/json/posts.json'));
        $posts = json_decode($posts);
        $posts = \App\Post::hydrate($posts);
        $posts = new \Illuminate\Pagination\LengthAwarePaginator($posts, count($posts), 4);
        $posts->withPath('/182410102024/uts/public/');
        return view('index')->with(['posts' => $posts, 'startPage' => $startPage, 'endPage' => ( ($startPage+4) > count($posts) ? count($posts) : $startPage+4)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

        return view('show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
