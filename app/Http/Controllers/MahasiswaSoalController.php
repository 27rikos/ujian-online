<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use App\Models\Soal;

class MahasiswaSoalController extends Controller
{
    public function uts($id)
    {
        $data = Soal::select('id', 'soal', 'kesulitan')->where('jenis_ujian', 'uts')->where('id_matakuliah', $id)->get();
        $matakuliah = Matakuliah::findOrFail($id);
        return view('mahasiswa.soal.index', compact('data', 'matakuliah'));
    }
    public function uas($id)
    {
        $data = Soal::select('id', 'soal', 'kesulitan')->where('jenis_ujian', 'uas')->where('id_matakuliah', $id)->get();
        $matakuliah = Matakuliah::findOrFail($id);
        return view('mahasiswa.soal.uas', compact('data', 'matakuliah'));
    }

}
