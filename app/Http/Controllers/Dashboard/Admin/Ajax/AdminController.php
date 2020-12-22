<?php

namespace App\Http\Controllers\Dashboard\Admin\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    public function getUsers(Request $request) 
    {
        $users = \App\User::where('role_id', '=', 2);
        // foto, email, nama, budidaya,status, action
        return DataTables::of($users)
            ->addColumn('photo', function($user) {
                return '<div class="table-img"><img src='. asset('storage/'.$user->photo) .' alt=""></div>';
            })
            ->addColumn('email', function($user) {
                return $user->email;
            })
            ->addColumn('name', function($user) {
                return $user->name;
            })
            ->addColumn('budidaya', function($user) {
                return count($user->budidayas);
            })
            ->addColumn('pekerja', function($user) {
                return $user->budidayas()->whereNotNull('maintenance_by_uid')
                                                ->groupBy('owned_by_uid')
                                                ->distinct('maintenance_by_uid')
                                                ->count('maintenance_by_uid');
            })
            ->addColumn('status', function($user) {
                if ($user->status === '0') {
                    return '<span class="badge badge-secondary">Nonaktif</span>';
                } else {
                    return '<span class="badge badge-success">Aktif</span>';
                }
            }) 
            ->addColumn('action', function($user) {
                return '<a data-toggle="delete" href="'.route('dashboard.admin.users.delete', $user).'" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                        <a href="'.route('dashboard.admin.users.edit', $user->id).'" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                        <a href="'.route('dashboard.admin.users.show', $user->id).'" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>';
            })
            ->rawColumns(['photo', 'status', 'action'])->make(true);
    }

    public function getPosts(Request $request)
    {
        $posts = \App\Post::orderBy('created_at', 'desc')->get();
        return DataTables::of($posts)
            ->addColumn('photo', function($post) {
                return '<div class="table-img"><img src='. asset('storage/'.$post->photo) .' alt=""></div>';
            })
            ->addColumn('slug', function($post) {
                return substr($post->slug, 0, 25).( (strlen($post->slug) > 25) ? '...' : ''  );
            })
            ->addColumn('title', function($post) {
                return substr($post->title, 0, 25).( (strlen($post->title) > 25) ? '...' : ''  );
            })
            ->addColumn('body', function($post) {
                return substr(strip_tags($post->body), 0, 40).( (strlen(strip_tags($post->body)) > 40) ? '...' : ''  );
            })
            ->addColumn('is_headline', function($post) {
                if ($post->is_headline === 'false') {
                    return '<span class="badge badge-secondary"><i class="fas fa-times"></i></span>';
                } else {
                    return '<span class="badge badge-success"><i class="fas fa-check"></i></span>';
                }
            })
            ->addColumn('action', function($post) {
                return '<a data-toggle="delete" href="'.route('dashboard.admin.posts.delete', $post).'" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                        <a href="'.route('dashboard.admin.posts.edit', $post).'" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                        <a href="'.route('dashboard.admin.posts.table.show', $post).'" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>';
            })
            ->rawColumns(['photo', 'is_headline', 'action'])->make(true);
    }

}
