<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $headlines = Post::where('is_headline', '=', 'true')->orderBy('created_at', 'desc')->get();
        $posts = Post::orderBy('created_at', 'desc')->where('is_headline', 'false')->paginate(2);
        $categories = \App\Category::all();
        $filtered = [];
        foreach ($posts as $i => $post) {
            array_push($filtered, ['id', '!=', $post->id]);
        }
        $otherPosts = Post::where($filtered)->take(4)->get();
        return view('dashboard.modules.admin.posts.index')
                ->withHeadlines($headlines)
                ->withPosts($posts)
                ->withOtherPosts($otherPosts)
                ->withCategories($categories);
    }

    public function table()
    {
        return view('dashboard.modules.admin.posts.table');
    }

    public function tableShow(Post $post)
    {
        return view('dashboard.modules.admin.posts.table-show')->with([
            'post' => $post
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = \App\Category::all();
        return view('dashboard.modules.admin.posts.create')
                ->withCategories($categories);
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
            'photo'             => 'sometimes|image',
            'title'             => 'required|max:191',
            'slug'              => 'required|alpha_dash|min:3|max:100|unique:posts,slug',
            'body'              => 'required|min:10',
            'is_headline'       => 'required',
            'category_id'       => 'required',
        ])->validate();

        $post = new Post;
        $post->title = $request->title;
        if ($request->file('photo')) {
            $file = $request->file('photo')->store('photo/posts', 'public');
            $post->photo = $file;
        }
        $post->slug = $request->slug;
        $post->body = $request->body;
        $post->is_headline = $request->is_headline;
        $post->category_id = $request->category_id;
        $post->created_at = now();
        $post->created_by_uid = \Auth::user()->id;

        $post->save();

        \Session::flash('alert-type', 'success'); 
        \Session::flash('alert-message', 'Data Post Berhasil Ditambahkan!'); 
        return redirect()->route('dashboard.admin.posts.create');

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $otherPosts = Post::where('id', '!=', $post->id)->take(4)->get();
        return view('dashboard.modules.admin.posts.show')->with([
            'post' => $post,
            'otherPosts' => $otherPosts
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = \App\Category::all();
        return view('dashboard.modules.admin.posts.edit')
                ->withPost($post)
                ->withCategories($categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $validation = \Validator::make($request->all(), [
            'title'             => 'required|max:191',
            'slug'              => "required|alpha_dash|min:3|max:100|unique:posts,slug,$post->id",
            'body'              => 'required|min:10',
            'is_headline'       => 'required',
            'category_id'       => 'required',
        ])->validate();

        $post->title = $request->title;
        if ($request->file('photo')) {
            if($post->photo && file_exists(storage_path('app/public/' . $post->photo))){
                \Storage::delete('public/'.$post->photo);
            }
            $file = $request->file('photo')->store('photo/posts', 'public');
            $post->photo = $file;
        }
        $post->slug = $request->slug;
        $post->body = $request->body;
        $post->is_headline = $request->is_headline;
        $post->category_id = $request->category_id;
        $post->updated_at = now();

        $post->save();

        \Session::flash('alert-type', 'success'); 
        \Session::flash('alert-message', 'Data Post Berhasil Diubah!'); 
        return redirect()->route('dashboard.admin.posts.edit', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function delete(Post $post)
    {
        \Storage::delete($post->photo);
        $post->delete();

        \Session::flash('alert-type', 'success'); 
        \Session::flash('alert-message', 'Data Post Berhasil Dihapus !'); 
        return redirect()->route('dashboard.admin.posts.table');
    }
}
