<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use App\Models\Nilai;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index()
    {
        $data = Matakuliah::all();
        return view('admin.nilai.index', compact('data'));
    }
    public function show($id)
    {

        $data = Nilai::with('matkul')->where('id_matakuliah', $id)->get();
        return view('admin.nilai.nilai', compact('data', 'id'));
    }
    public function edit($id, $id_nilai)
    {
        $find = Nilai::findOrFail($id_nilai);
        return view('admin.nilai.edit', compact('find', 'id'));
    }
    public function update(Request $request, $id, $id_nilai)
    {
        $data = Nilai::findOrFail($id_nilai);
        $data->update($request->all());
        return redirect('show-nilai/' . $id)->with('toast_success', 'Nilai Diperbarui');
    }
}