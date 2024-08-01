<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;

class MahasiswaMatakuliahController extends Controller
{
    public function uts()
    {
        // $status_button = Nilai::where('nama_mahasiswa', auth()->user()->name)->value('uts');
        $matakuliah = Matakuliah::all();
        return view('mahasiswa.matakuliah.index', compact('matakuliah', ));
    }
    public function uas()
    {
        // $status_button = Nilai::where('nama_mahasiswa', auth()->user()->name)->value('uas');
        $matakuliah = Matakuliah::all();
        return view('mahasiswa.matakuliah.uas', compact('matakuliah', ));
    }
}