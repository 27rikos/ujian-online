<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Matakuliah;
use App\Models\Soal;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $jawaban = History::count();
        $user = User::count();
        $matkul = Matakuliah::count();
        $soal = Soal::count();
        return view('admin.dashboard.index', compact('user', 'matkul', 'soal', 'jawaban'));
    }
}