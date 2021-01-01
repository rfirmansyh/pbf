<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total_user = User::count();
        $total_user_admin = User::where('role_id', 1)->count();
        $total_user_member = User::where('role_id', 2)->count();
        return view('dashboard.modules.admin.users.index')->with([
            'total_user' => $total_user,
            'total_user_admin' => $total_user_admin,
            'total_user_member' => $total_user_member,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = \App\Role::orderBy('id', 'desc')->get();
        return view('dashboard.modules.admin.users.create')->with([
            'roles' => $roles
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
            'name'                  => 'required|min:5|max:191',
            'email'                 => 'required|email|unique:users',
            'password'              => 'required|min:3',
            'phone'                 => 'required|digits_between:10,12',
            'status'                => 'required',
            'address'               => 'required',
            'role_id'               => 'required',
        ])->validate();

        $user = new User;
        if ($request->file('photo')) {
            $file = $request->file('photo')->store('users', 'public');
            $user->photo = $file;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->status = $request->status;
        $user->role_id = $request->role_id;

        $user->save();
        \Session::flash('alert-type', 'success'); 
        \Session::flash('alert-message', 'Data Anggota Baru Berhasil Ditambahkan!'); 
        
        return redirect()->route('dashboard.admin.users.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $roles = \App\Role::orderBy('id', 'desc')->get();
        return view('dashboard.modules.admin.users.show')->with([
            'roles' => $roles,
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = \App\Role::orderBy('id', 'desc')->get();
        return view('dashboard.modules.admin.users.edit')->with([
            'roles' => $roles,
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $validation = \Validator::make($request->all(), [
            'name'                  => 'required|min:5|max:191',
            'phone'                 => 'required|digits_between:10,12',
            'status'                => 'required',
            'address'               => 'required',
            'role_id'               => 'required',
        ])->validate();

        $user = $user;
        if ($request->file('photo')) {
            if($user->photo && file_exists(storage_path('app/public/' . $user->photo))){
                \Storage::delete('public/'.$user->photo);
            }
            $file = $request->file('photo')->store('users', 'public');
            $user->photo = $file;
        }
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->status = $request->status;
        $user->role_id = $request->role_id;

        $user->save();
        \Session::flash('alert-type', 'success'); 
        \Session::flash('alert-message', 'Data Anggota Baru Berhasil Diubah!'); 
        
        return redirect()->route('dashboard.admin.users.edit', $user);
    }

    public function changepassword(Request $request, User $user)
    {
        $validation = \Validator::make($request->all(), [
            'password'              => 'required|min:3',
        ])->validate();

        $user = $user;
        $user->save();
        \Session::flash('alert-type', 'success'); 
        \Session::flash('alert-message', 'Data Anggota Baru Berhasil Diubah!'); 
        
        return redirect()->route('dashboard.admin.users.edit', $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    
}
