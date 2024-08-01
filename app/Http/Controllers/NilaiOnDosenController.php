<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use App\Models\Nilai;
use Illuminate\Http\Request;

class NilaiOnDosenController extends Controller
{
    public function index()
    {
        $data = Matakuliah::where('dosen', auth()->user()->name)->get();
        return view('dosen.nilai.index', compact('data'));
    }
    public function show($id)
    {
        $data = Nilai::where('id_matakuliah', $id)->get();
        return view('dosen.nilai.nilai', compact('data', 'id'));
    }
    public function edit($id, $id_nilai)
    {
        $find = Nilai::findOrFail($id_nilai);
        return view('dosen.nilai.edit', compact('find', 'id'));
    }
    public function update(Request $request, $id, $id_nilai)
    {
        $data = Nilai::findOrFail($id_nilai);
        $data->update($request->all());
        return redirect('dosen-show-nilai/' . $id)->with('toast_success', 'Nilai Diperbarui');
    }
}
