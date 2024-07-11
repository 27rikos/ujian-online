<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use App\Models\User;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Matakuliah::all();
        return view('admin.matakuliah.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = User::where('role', 'dosen')->get();
        return view('admin.matakuliah.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kode_matakuliah' => 'required',
            'matakuliah' => 'required',
            'prodi' => 'required',
            'semester' => 'required',
            'sks' => 'required',
            'dosen' => 'required',
            'duration' => 'required',
        ]);
        $data = Matakuliah::create($request->all());
        $data->save();
        return redirect()->route('matakuliah.index')->with('toast_success', 'Matakuliah Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Matakuliah $matakuliah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $dosen = User::where('role', 'dosen')->get();
        $data = Matakuliah::findOrFail($id);
        return view('admin.matakuliah.edit', compact('data', 'dosen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = Matakuliah::findOrFail($id);
        $data->update($request->all());
        $data->save();
        return redirect()->route('matakuliah.index')->with('toast_success', 'Matakuliah Diubah');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Matakuliah::findOrFail($id);
        $data->delete();
        return redirect()->route('matakuliah.index')->with('toast_success', 'Matakuliah Dihapus');
    }
}
