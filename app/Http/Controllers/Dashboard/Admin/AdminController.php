<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{

    public function index()
    {
        return view('dashboard.modules.admin.index');
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

    public function updateProfile(Request $request, User $user)
    {
        $request->validate([
            'name'                  => 'required|min:5|max:191',
            'phone'                 => 'required|digits_between:10,12',
            'address'               => 'required',
        ]);

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

        $user->save();
        \Session::flash('alert-type', 'success'); 
        \Session::flash('alert-message', 'Data Anggota Baru Berhasil Diubah!'); 
        
        return redirect()->route('dashboard.admin.profile.edit');
    }

    public function changepassword(Request $request, User $user)
    {
        $request->validate([
            'password'              => 'required|min:3',
        ]);

        $user = $user;
        $user->password = bcrypt($request->password);
        $user->save();
        \Session::flash('alert-type', 'success'); 
        \Session::flash('alert-message', 'Password Berhasil Diubah!'); 
        
        return redirect()->route('dashboard.admin.profile.edit');
    }
}
