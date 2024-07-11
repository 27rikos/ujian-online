<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Matakuliah;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwal = Jadwal::all();
        return view('admin.jadwal.index', compact('jadwal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $matakuliah = Matakuliah::select('matakuliah')->get();
        return view('admin.jadwal.create', compact('matakuliah'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'tanggal' => 'required',
            'matakuliah' => 'required',
            'start' => 'required',
            'end' => 'required',
            'sks' => 'required',
        ]);
        $data = Jadwal::create($request->all());
        $data->save();
        return redirect()->route('jadwal.index')->with('toast_success', 'Jadwal Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jadwal $jadwal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $matakuliah = Matakuliah::select('matakuliah')->get();
        $find = Jadwal::findOrFail($id);
        return view('admin.jadwal.edit', compact('matakuliah', 'find'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = Jadwal::findOrFail($id);
        $data->update($request->all());
        $data->save();
        return redirect()->route('jadwal.index')->with('toast_success', 'Jadwal Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Jadwal::findOrFail($id);
        $data->delete();
        return redirect()->route('jadwal.index')->with('toast_success', 'Jadwal Dihapus');
    }
}
