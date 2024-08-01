<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;

class MahasiswaController extends Controller
{
    public function index()
    {
        $data = Jadwal::all();
        return view('mahasiswa.dashboard.index', compact('data'));
    }
}