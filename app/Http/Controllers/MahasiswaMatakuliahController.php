<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Matakuliah;
use App\Models\Nilai;

class MahasiswaMatakuliahController extends Controller
{
    public function uts()
    {
        $chance = Nilai::value('utschance');
        $jadwal = Jadwal::select('tanggal', 'matakuliah', 'start')->get();
        $matakuliah = Matakuliah::all();
        return view('mahasiswa.matakuliah.index', compact('matakuliah', 'chance', 'jadwal'));
    }
    public function uas()
    {
        $chance = Nilai::value('uaschance');
        $matakuliah = Matakuliah::all();
        $jadwal = Jadwal::select('tanggal', 'matakuliah', 'start')->get();
        return view('mahasiswa.matakuliah.uas', compact('jadwal', 'matakuliah', 'chance'));
    }
}