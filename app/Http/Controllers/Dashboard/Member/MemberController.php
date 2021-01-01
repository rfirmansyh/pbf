<?php

namespace App\Http\Controllers\Dashboard\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class MemberController extends Controller
{
    public function index()
    {
        return view('dashboard.modules.member.index');
    }

    public function indexProfile()
    {
        return view('dashboard.modules.member.profile.index')->with([
            'user' => \Auth::user()
        ]);
    }

    public function editProfile()
    {
        return view('dashboard.modules.member.profile.edit')->with([
            'user' => \Auth::user()
        ]);
    }

    public function updateProfile(Request $request, User $user)
    {
        $validation = \Validator::make($request->all(), [
            'name'                  => 'required|min:5|max:191',
            'phone'                 => 'required|digits_between:10,12',
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

        $user->save();
        \Session::flash('alert-type', 'success'); 
        \Session::flash('alert-message', 'Data Anggota Baru Berhasil Diubah!'); 
        
        return redirect()->route('dashboard.member.profile.edit');
    }

    public function changepassword(Request $request, User $user)
    {
        $validation = \Validator::make($request->all(), [
            'password'              => 'required|min:8',
        ])->validate();

        $user = $user;
        $user->password = bcrypt($request->password);
        $user->save();
        \Session::flash('alert-type', 'success'); 
        \Session::flash('alert-message', 'Password Berhasil Diubah!'); 
        
        return redirect()->route('dashboard.member.profile.edit');
    }
}
