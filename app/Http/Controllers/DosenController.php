<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;

class DosenController extends Controller
{
    public function index()
    {
        $data = Jadwal::all();
        return view('dosen.dashboard.index', compact('data'));
    }
}