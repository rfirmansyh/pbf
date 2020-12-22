<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

//     SELECT COUNT(DISTINCT maintenance_by_uid)
// FROM `budidayas` 
// WHERE `owned_by_uid` = 2 and `maintenance_by_uid` is NOT null
// GROUP BY `owned_by_uid`
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // $pekerja = \App\Budidaya::where('owned_by_uid', 3)
        //                             ->whereNotNull('maintenance_by_uid')
        //                             ->groupBy('owned_by_uid')
        //                             ->distinct('maintenance_by_uid')->count('maintenance_by_uid');
        // $pekerja = User::find('4')->budidayas()
        //                 ->whereNotNull('maintenance_by_uid')
        //                 ->groupBy('owned_by_uid')
        //                 ->distinct('maintenance_by_uid')
        //                 ->count('maintenance_by_uid'); 
        // mencari pekerja dari mitra terkait
        // $pekerja = User::find('2')->budidayas()->get();
        $users = \App\User::where('role_id', '=', 2)->get();
        return view('dashboard.modules.admin.users.index')->with([
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $password = getRandomPassword();
        return view('dashboard.modules.admin.users.create')->withPassword($password);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $messages = [
        //     'required'  => ':attribute Harus Diisi'
        // ];
        // $validation = \Validator::make($request->all(), [
        //     'name'                  => 'required|min:5|max:191',
        //     'email'                 => 'requir,ed|email|unique:users',
        //     'password'              => 'required|min:8',
        //     'phone'                 => 'required|digits_between:10,12',
        //     'status'                => 'required',
        // ], $messages)->validate();
        $validation = \Validator::make($request->all(), [
            'name'                  => 'required|min:5|max:191',
            'email'                 => 'required|email|unique:users',
            'password'              => 'required|min:8',
            'phone'                 => 'required|digits_between:10,12',
            'status'                => 'required',
        ])->validate();

        $user = new User;
        $user->name = $request->name;
        if ($request->file('photo')) {
            $file = $request->file('photo')->store('photo/profile', 'public');
            $user->photo = $file;
        }
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->bio = $request->bio;
        $user->provinsi = $request->provinsi;
        $user->kabupaten = $request->kabupaten;
        $user->kecamatan = $request->kecamatan;
        $user->kelurahan = $request->kelurahan;
        $user->detail_address = $request->detail_address;
        $user->status = $request->status;
        $user->created_at = now();
        $user->role_id = '2';

        $user->save();

        \Session::flash('alert-type', 'success'); 
        \Session::flash('alert-message', 'Data Mitra Berhasil Ditambahkan!'); 

        $password = getRandomPassword();
        return redirect()->route('dashboard.admin.users.create')->withPassword($password);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.modules.admin.users.show')->with(['user' => $user]);
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
        $user = User::findOrFail($id);
        return view('dashboard.modules.admin.users.edit')->with(['user' => $user]);
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
        $validation = \Validator::make($request->all(), [
            'name'                  => 'required|min:5|max:191',
            'phone'                 => 'required|digits_between:10,12',
            'status'                => 'required',
        ])->validate();

        $user = User::findOrFail($id);
        $user->name = $request->name;
        if ($request->file('photo')) {
            if($user->photo && file_exists(storage_path('app/public/' . $user->photo))){
                \Storage::delete('public/'.$user->photo);
            }
            $file = $request->file('photo')->store('photo/profile', 'public');
            $user->photo = $file;
        }
        $user->phone = $request->phone;
        $user->bio = $request->bio;
        if ($request->provinsi && $request->kabupaten && $request->kecamatan && $request->kelurahan) {
            $user->provinsi = $request->provinsi;
            $user->kabupaten = $request->kabupaten;
            $user->kecamatan = $request->kecamatan;
            $user->kelurahan = $request->kelurahan;
        }
        if ($request->detail_address){
            $user->detail_address = $request->detail_address;
        }
        $user->status = $request->status;

        $user->save();

        \Session::flash('alert-type', 'success'); 
        \Session::flash('alert-message', 'Data Pengurus Berhasil Ditambahkan!'); 

        return redirect()->route('dashboard.admin.users.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(User $user)
    {
        \Storage::delete($user->photo);
        $user->delete();

        \Session::flash('alert-type', 'success'); 
        \Session::flash('alert-message', 'Data User Berhasil Dihapus !'); 
        return redirect()->route('dashboard.admin.users.index');
    }
}
