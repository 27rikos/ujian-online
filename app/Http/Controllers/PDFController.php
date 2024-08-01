<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use App\Models\Nilai;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function adminpdf($id)
    {
        $data = Nilai::with('matkul')->where('id_matakuliah', $id)->get();
        $matkul = Matakuliah::where('id', $id)->first();
        $pdf = Pdf::loadView('admin.print.generate-pdf', ['data' => $data], ['matkul' => $matkul]);
        return $pdf->download('nilai.pdf');
    }
    public function dosenpdf($id)
    {
        $data = Nilai::with('matkul')->where('id_matakuliah', $id)->get();
        $matkul = Matakuliah::where('id', $id)->first();
        $pdf = Pdf::loadView('dosen.print.generate', ['data' => $data], ['matkul' => $matkul]);
        return $pdf->download('nilai.pdf');
    }
}