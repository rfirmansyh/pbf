<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{

    public function index()
    {
        return ('dashboard.modules.admin.index');
    }

    public function indexProfile()
    {
        return view('dashboard.modules.admin.profile.index')->with([
            'user' => \Auth::user()
        ]);
    }

    public function editProfile()
    {
        return view('dashboard.modules.admin.profile.edit')->with([
            'user' => \Auth::user()
        ]);
    }

    public function updateProfile()
    {
        $validation = \Validator::make($request->all(), [
            'name'                  => 'required|min:5|max:191',
            'phone'                 => 'required|digits_between:10,12',
            'status'                => 'required',
            'address'               => 'required',
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
}
