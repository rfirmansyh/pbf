<?php

namespace App\Http\Controllers\Dashboard\Mitra;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $headlines = Post::where('is_headline', '=', 'true')->get();
        $posts = Post::orderBy('created_at', 'desc')->where('is_headline', 'false')->paginate(2);
        $categories = \App\Category::all();
        $filtered = [];
        foreach ($posts as $i => $post) {
            array_push($filtered, ['id', '!=', $post->id]);
        }
        $otherPosts = Post::where($filtered)->take(4)->get();
        return view('dashboard.modules.mitra.posts.index')
                ->withHeadlines($headlines)
                ->withPosts($posts)
                ->withOtherPosts($otherPosts)
                ->withCategories($categories);
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
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $otherPosts = Post::where('id', '!=', $post->id)->take(4)->get();
        return view('dashboard.modules.mitra.posts.show')
                ->withPost($post)
                ->withOtherPosts($otherPosts);
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
