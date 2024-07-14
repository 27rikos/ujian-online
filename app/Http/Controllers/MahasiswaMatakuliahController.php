<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;

class MahasiswaMatakuliahController extends Controller
{
    public function uts()
    {
        $matakuliah = Matakuliah::all();
        return view('mahasiswa.matakuliah.index', compact('matakuliah', ));
    }
    public function uas()
    {
        $matakuliah = Matakuliah::all();
        return view('mahasiswa.matakuliah.uas', compact('matakuliah', ));
    }
}