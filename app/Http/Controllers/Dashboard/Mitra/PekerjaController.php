<?php

namespace App\Http\Controllers\Dashboard\Mitra;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class PekerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalPekerjas = \Auth::user()->workers()->count();
        $totalPekerjasActive = \Auth::user()->workers()->where('status', '1')->count();
        $totalPekerjasNonActive = \Auth::user()->workers()->where('status', '0')->count();
        return view('dashboard.modules.mitra.pekerjas.index')->with([
            'totalPekerjas' => $totalPekerjas,
            'totalPekerjasActive' => $totalPekerjasActive,
            'totalPekerjasNonActive' => $totalPekerjasNonActive
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
        return view('dashboard.modules.mitra.pekerjas.create')->withPassword($password);
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
        $user->manager_id = \Auth::user()->id;
        $user->role_id = '3';

        $user->save();

        \Session::flash('alert-type', 'success'); 
        \Session::flash('alert-message', 'Data Pekerja Berhasil Ditambahkan!'); 

        $password = getRandomPassword();
        return redirect()->route('dashboard.mitra.pekerjas.create')->withPassword($password);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pekerja = User::findOrFail($id);
        return view('dashboard.modules.mitra.pekerjas.show')->with([
            'pekerja' => $pekerja
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pekerja = User::findOrFail($id);
        return view('dashboard.modules.mitra.pekerjas.edit')
                ->withPekerja($pekerja);
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
        \Session::flash('alert-message', 'Data Pekerja Berhasil Diubah!'); 

        return redirect()->route('dashboard.mitra.pekerjas.edit', $id);
    }

    public function updatePassword(Request $request, $id)
    {
        $validation = \Validator::make($request->all(), [
            'password'              => 'required|min:8',
        ])->validate();

        $user = User::findOrFail($id);
        $user->password = $request->password;

        $user->save();

        \Session::flash('alert-type', 'success'); 
        \Session::flash('alert-message', 'Data Password Pekerja Berhasil Diubah!'); 

        return redirect()->route('dashboard.mitra.pekerjas.edit', $id);
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
