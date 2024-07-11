<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use App\Models\Soal;
use Illuminate\Http\Request;

class DosenSoalController extends Controller
{
    public function index($id)
    {
        $data = Soal::where('id_matakuliah', $id)->get();
        $matakuliah = Matakuliah::findOrFail($id);
        return view('dosen.soal.index', compact('data', 'matakuliah'));

    }
    public function create($id)
    {
        $matakuliah = Matakuliah::findOrFail($id);
        return view('dosen.soal.create', compact('matakuliah'));

    }
    public function store(Request $request, $id)
    {

        $this->validate($request, [
            'soal' => 'required',
            'kesulitan' => 'required',
            'kunci' => 'required',
        ]);
        $data = Soal::create([
            'id_matakuliah' => $id,
            'soal' => $request->soal,
            'kesulitan' => $request->kesulitan,
            'kunci' => $request->kunci,
        ]);
        $data->save();
        return redirect('soal-dosen/' . $id)->with('toast_success', 'Soal Ditambahkan');
    }
    public function edit($soal, $matakuliah)
    {
        $id = $matakuliah;
        $find = Soal::findOrFail($soal);
        return view('dosen.soal.edit', compact('id', 'find'));
    }
    public function update(Request $request, $soal, $matakuliah)
    {
        $data = Soal::findOrFail($soal);
        $data->update([
            'soal' => $request->soal,
            'kesulitan' => $request->kesulitan,
            'kunci' => $request->kunci,
        ]);
        return redirect('soal-dosen/' . $matakuliah)->with('toast_success', 'Soal Diubah');
    }
    public function destroy($soal, $matakuliah)
    {
        $data = Soal::findOrFail($soal);
        $data->delete();
        return redirect('soal-dosen/' . $matakuliah)->with('toast_success', 'Soal Dihapus');
    }
}
