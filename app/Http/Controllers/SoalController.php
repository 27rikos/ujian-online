<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use App\Models\Soal;
use Illuminate\Http\Request;

class SoalController extends Controller
{
    public function index($id)
    {
        $data = Soal::where('id_matakuliah', $id)->get();
        $matakuliah = Matakuliah::findOrFail($id);
        return view('admin.soal.index', compact('matakuliah', 'data'));
    }
    public function create($id)
    {
        $matakuliah = Matakuliah::findOrFail($id);
        return view('admin.soal.create', compact('matakuliah'));
    }
    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'soal' => 'required',
            'kesulitan' => 'required',
            'kunci' => 'required',
            'jenis_ujian' => 'required',
        ]);
        $data = Soal::create([
            'id_matakuliah' => $id,
            'soal' => $request->soal,
            'jenis_ujian' => $request->jenis_ujian,
            'kesulitan' => $request->kesulitan,
            'kunci' => $request->kunci,
        ]);
        $data->save();

        return redirect('soal/' . $id)->with('toast_success', 'Soal Ditambahkan');
    }
    public function edit($soal, $matakuliah)
    {
        $id = $matakuliah;
        $find = Soal::findOrFail($soal);
        return view('admin.soal.edit', compact('id', 'find'));
    }
    public function update(Request $request, $soal, $matakuliah)
    {
        $data = Soal::findOrFail($soal);
        $data->update([
            'soal' => $request->soal,
            'jenis_ujian' => $request->jenis_ujian,
            'kesulitan' => $request->kesulitan,
            'kunci' => $request->kunci,
        ]);
        return redirect('soal/' . $matakuliah)->with('toast_success', 'Soal Diubah');
    }
    public function destroy($soal, $matakuliah)
    {
        $data = Soal::findOrFail($soal);
        $data->delete();
        return redirect('soal/' . $matakuliah)->with('toast_success', 'Soal Dihapus');
    }
}
