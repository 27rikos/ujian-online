<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;

class MahasiswaMatakuliahController extends Controller
{
    public function index()
    {
        $matakuliah = Matakuliah::all();
        return view('mahasiswa.matakuliah.index', compact('matakuliah', ));
    }
}
