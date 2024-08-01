<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use App\Models\Nilai;

class NilaiOnMahasiswaController extends Controller
{
    public function index()
    {
        $data = Matakuliah::all();
        return view('mahasiswa.nilai.index', compact('data'));
    }
    public function show($id)
    {
        $data = Nilai::where('id_matakuliah', $id)->where('nama_mahasiswa', auth()->user()->name)->get();
        return view('mahasiswa.nilai.nilai', compact('data'));
    }
}