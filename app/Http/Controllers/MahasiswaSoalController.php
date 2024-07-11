<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use App\Models\Soal;

class MahasiswaSoalController extends Controller
{
    public function index($id)
    {
        $data = Soal::select('id', 'soal', 'kesulitan')->where('id_matakuliah', $id)->get();
        $data = $data->shuffle();
        $matakuliah = Matakuliah::findOrFail($id);
        return view('mahasiswa.soal.index', compact('data', 'matakuliah'));
    }

}
