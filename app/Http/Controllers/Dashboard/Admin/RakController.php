<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Rak;
use Illuminate\Http\Request;

class RakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $raks = Rak::orderBy('created_at', 'desc')->paginate(6);
        if ($request->search) {
            $raks = Rak::where('name', 'LIKE', "%$request->search%")->orWhere('location', 'LIKE', "%$request->search%")->orderBy('created_at', 'desc')->paginate(6);
        }
        return view('dashboard.modules.admin.raks.index')->with([
            'raks' => $raks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.modules.admin.raks.create');
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
            'name'                   => 'required',
            'location'                => 'required',
        ])->validate();

        $rak = new Rak;
        if ($request->file('photo')) {
            $file = $request->file('photo')->store('raks', 'public');
            $rak->photo = $file;
        }
        $rak->name = $request->name;
        $rak->location = $request->location;
        $rak->save();
        \Session::flash('alert-type', 'success'); 
        \Session::flash('alert-message', 'Data Rak Berhasil Ditambahkan!'); 
        
        return redirect()->route('dashboard.admin.raks.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rak  $rak
     * @return \Illuminate\Http\Response
     */
    public function show(Rak $rak)
    {
        return view('dashboard.modules.admin.raks.show')->with([
            'rak' => $rak
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rak  $rak
     * @return \Illuminate\Http\Response
     */
    public function edit(Rak $rak)
    {
        return view('dashboard.modules.admin.raks.edit')->with([
            'rak' => $rak
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rak  $rak
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rak $rak)
    {
        $validation = \Validator::make($request->all(), [
            'name'                   => 'required',
            'location'                => 'required',
        ])->validate();

        $rak = $rak;
        if ($request->file('photo')) {
            if($rak->photo && file_exists(storage_path('app/public/' . $rak->photo))){
                \Storage::delete('public/'.$rak->photo);
            }
            $file = $request->file('photo')->store('raks', 'public');
            $rak->photo = $file;
        }
        $rak->name = $request->name;
        $rak->location = $request->location;
        $rak->save();
        \Session::flash('alert-type', 'success'); 
        \Session::flash('alert-message', 'Data Rak Berhasil Diubah!'); 
        
        return redirect()->route('dashboard.admin.raks.edit', $rak);
    }

}
